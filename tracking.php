<?php
require_once 'config.php';
require_once 'db.php';

class Tracking {
    private $db;
    private $visitor_id;
    private $visit_id;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
        $this->visitor_id = $this->getOrCreateVisitorId();
    }

    private function getOrCreateVisitorId() {
        if (!isset($_COOKIE['visitor_id'])) {
            $visitor_id = uniqid('vis_', true);
            setcookie('visitor_id', $visitor_id, time() + (86400 * 365), '/');
            return $visitor_id;
        }
        return $_COOKIE['visitor_id'];
    }

    public function trackPageView() {
        try {
            // Inserimento visita
            $stmt = $this->db->prepare("
                INSERT INTO visits (
                    visitor_id, ip_address, user_agent, page_url, 
                    referrer, device_type, browser
                ) VALUES (?, ?, ?, ?, ?, ?, ?)
            ");

            $stmt->execute([
                $this->visitor_id,
                $_SERVER['REMOTE_ADDR'],
                $_SERVER['HTTP_USER_AGENT'],
                $_SERVER['REQUEST_URI'],
                $_SERVER['HTTP_REFERER'] ?? null,
                $this->getDeviceType(),
                $this->getBrowser()
            ]);

            $this->visit_id = $this->db->lastInsertId();

            // Inserimento visualizzazione pagina
            $stmt = $this->db->prepare("
                INSERT INTO page_views (visit_id, page_url)
                VALUES (?, ?)
            ");

            $stmt->execute([
                $this->visit_id,
                $_SERVER['REQUEST_URI']
            ]);

            return true;
        } catch (Exception $e) {
            error_log("Errore nel tracciamento: " . $e->getMessage());
            return false;
        }
    }

    public function trackEvent($event_name, $event_category, $event_value = null) {
        try {
            $stmt = $this->db->prepare("
                INSERT INTO events (visit_id, event_name, event_category, event_value)
                VALUES (?, ?, ?, ?)
            ");

            $stmt->execute([
                $this->visit_id,
                $event_name,
                $event_category,
                $event_value
            ]);

            return true;
        } catch (Exception $e) {
            error_log("Errore nel tracciamento evento: " . $e->getMessage());
            return false;
        }
    }

    private function getDeviceType() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', $user_agent)) {
            return 'tablet';
        }
        if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', $user_agent)) {
            return 'mobile';
        }
        return 'desktop';
    }

    private function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser_list = [
            'Chrome' => '/chrome/i',
            'Firefox' => '/firefox/i',
            'Safari' => '/safari/i',
            'Opera' => '/opera|OPR/i',
            'Edge' => '/edge/i',
            'IE' => '/msie|trident/i'
        ];

        foreach ($browser_list as $browser => $pattern) {
            if (preg_match($pattern, $user_agent)) {
                return $browser;
            }
        }
        return 'Unknown';
    }
}

// Inizializzazione del tracciamento
$tracking = new Tracking();
$tracking->trackPageView();
?> 