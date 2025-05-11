import mysql.connector
import pandas as pd
import numpy as np
from datetime import datetime
import plotly.express as px
import plotly.graph_objects as go
from google.analytics.data_v1beta import BetaAnalyticsDataClient
from google.analytics.data_v1beta.types import RunReportRequest

# Configurazione connessione MySQL
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'fantaricky_db'
}

def connect_to_mysql():
    try:
        connection = mysql.connector.connect(**db_config)
        print("Connessione a MySQL riuscita!")
        return connection
    except mysql.connector.Error as err:
        print(f"Errore di connessione: {err}")
        return None

def export_to_excel(data, filename):
    try:
        data.to_excel(f'analisi/{filename}.xlsx', index=False)
        print(f"Dati esportati con successo in {filename}.xlsx")
    except Exception as e:
        print(f"Errore nell'esportazione: {e}")

def analyze_website_data():
    connection = connect_to_mysql()
    if not connection:
        return

    try:
        # Query per analisi base
        queries = {
            'visite_giornaliere': """
                SELECT DATE(created_at) as data, COUNT(*) as visite
                FROM visits
                GROUP BY DATE(created_at)
                ORDER BY data DESC
            """,
            'pagine_piu_visitata': """
                SELECT page_url, COUNT(*) as visite
                FROM page_views
                GROUP BY page_url
                ORDER BY visite DESC
                LIMIT 10
            """
        }

        results = {}
        for name, query in queries.items():
            df = pd.read_sql(query, connection)
            results[name] = df
            export_to_excel(df, name)

        # Creazione grafici
        for name, df in results.items():
            if name == 'visite_giornaliere':
                fig = px.line(df, x='data', y='visite', title='Visite Giornaliere')
                fig.write_html(f'analisi/{name}_chart.html')
            elif name == 'pagine_piu_visitata':
                fig = px.bar(df, x='page_url', y='visite', title='Pagine Più Visitate')
                fig.write_html(f'analisi/{name}_chart.html')

    except Exception as e:
        print(f"Errore durante l'analisi: {e}")
    finally:
        connection.close()

def get_google_analytics_data():
    try:
        client = BetaAnalyticsDataClient()
        property_id = "YOUR_PROPERTY_ID"  # Sostituire con il tuo ID proprietà
        
        request = RunReportRequest(
            property=f"properties/{property_id}",
            dimensions=[{"name": "date"}],
            metrics=[{"name": "activeUsers"}],
            date_ranges=[{"start_date": "30daysAgo", "end_date": "today"}]
        )
        
        response = client.run_report(request)
        return response
    except Exception as e:
        print(f"Errore nel recupero dati Google Analytics: {e}")
        return None

if __name__ == "__main__":
    analyze_website_data()
    ga_data = get_google_analytics_data() 