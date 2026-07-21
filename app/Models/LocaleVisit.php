<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocaleVisit extends Model
{
    protected $fillable = [
        'locale',
        'user_agent',
        'browser',
        'os',
        'device_type',
        'ip_address'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function parseBrowserInfo($userAgent)
    {
        if (empty($userAgent)) {
            return ['browser' => 'Unknown', 'os' => 'Unknown', 'device_type' => 'desktop'];
        }

        $browser = 'Unknown';
        $os = 'Unknown';
        $deviceType = 'desktop';

        $lowerAgent = strtolower($userAgent);

        if (stripos($userAgent, 'opr') !== false || stripos($userAgent, 'opera') !== false) {
            $browser = 'Opera';
        } elseif (stripos($userAgent, 'edg') !== false) {
            $browser = 'Edge';
        } elseif (stripos($userAgent, 'chrome') !== false) {
            $browser = 'Chrome';
        } elseif (stripos($userAgent, 'safari') !== false) {
            $browser = 'Safari';
        } elseif (stripos($userAgent, 'firefox') !== false) {
            $browser = 'Firefox';
        } elseif (stripos($userAgent, 'msie') !== false || stripos($userAgent, 'trident') !== false) {
            $browser = 'IE';
        }

        if (stripos($userAgent, 'windows') !== false) {
            $os = 'Windows';
        } elseif (stripos($userAgent, 'macintosh') !== false || stripos($userAgent, 'mac os') !== false) {
            $os = 'MacOS';
        } elseif (stripos($userAgent, 'linux') !== false) {
            $os = 'Linux';
        } elseif (stripos($userAgent, 'android') !== false) {
            $os = 'Android';
        } elseif (stripos($userAgent, 'iphone') !== false || stripos($userAgent, 'ipad') !== false) {
            $os = 'iOS';
        }

        if (stripos($userAgent, 'mobile') !== false || stripos($userAgent, 'android') !== false || stripos($userAgent, 'iphone') !== false) {
            $deviceType = 'mobile';
        } elseif (stripos($userAgent, 'tablet') !== false || stripos($userAgent, 'ipad') !== false) {
            $deviceType = 'tablet';
        }

        return [
            'browser' => $browser,
            'os' => $os,
            'device_type' => $deviceType
        ];
    }

    public function getBrowserIconAttribute()
    {
        $icons = [
            'Chrome' => '🌐',
            'Firefox' => '🦊',
            'Safari' => '🧭',
            'Edge' => '🌊',
            'Opera' => '🎭',
            'IE' => '💻',
            'Unknown' => '🌍'
        ];

        return $icons[$this->browser] ?? '🌍';
    }

    public function getOsIconAttribute()
    {
        $icons = [
            'Windows' => '🪟',
            'MacOS' => '🍎',
            'Linux' => '🐧',
            'Android' => '🤖',
            'iOS' => '📱',
            'Unknown' => '💻'
        ];

        return $icons[$this->os] ?? '💻';
    }

    public function getDeviceIconAttribute()
    {
        $icons = [
            'mobile' => '📱',
            'tablet' => '📱',
            'desktop' => '🖥️'
        ];

        return $icons[$this->device_type] ?? '🖥️';
    }
}
