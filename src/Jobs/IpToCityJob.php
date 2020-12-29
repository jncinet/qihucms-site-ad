<?php

namespace Qihucms\SiteAd\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Qihucms\SiteAd\Models\SiteAdLog;
use Qihucms\TencentLbs\TencentLbs;

/**
 * IP转换为城市信息
 * Class IpToCityJob
 * @package Qihucms\SiteAd\Jobs
 */
class IpToCityJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $adLog;

    /**
     * Create a new job instance.
     *
     * @param SiteAdLog $adLog
     * @return void
     */
    public function __construct(SiteAdLog $adLog)
    {
        $this->adLog = $adLog;
    }

    /**
     * 将IP地址转换为城市信息并存储到数据库中
     *
     * @return void
     */
    public function handle()
    {
        if (!empty($this->adLog->ip) && empty($this->adLog->province)) {
            $result = app(TencentLbs::class)->ipLocation($this->adLog->ip);

            if (isset($result['result']['ad_info']) && (int)$result['status'] === 0) {
                $this->adLog->province = $result['result']['ad_info']['province'] ?? null;
                $this->adLog->city = $result['result']['ad_info']['city'] ?? null;
                $this->adLog->district = $result['result']['ad_info']['district'] ?? null;
                $this->adLog->save();
            }
        }
    }
}
