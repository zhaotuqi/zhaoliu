<?php

namespace App\Http\Controllers;

use App\Services\ParticleServices;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    //
    public function __construct()
    {
    }

    //首页
    public function index($name = 'Laravel')
    {
        return view('index', ['name' => ucwords($name), 'id' => $this->selfId(), 'time' => $this->time()]);
    }

    //生成ID
    public function selfId()
    {
        return ParticleServices::generateParticle();
    }

    //ID转换时间
    public function time()
    {
        return ParticleServices::timeFromParticle($this->selfId());
    }
}
