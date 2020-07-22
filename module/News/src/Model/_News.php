<?php

namespace News\Model;

class News
{
    public $id;
    
    public $time_create;
    
    public $time_update;

    public $title;

    public $preview;
    
    public $body_text;

    public $publish;

    public function exchangeArray(array $data)
    {
        $this->id     = !empty($data['id']) ? $data['id'] : null;
        
        $this->time_create = !empty($data['time_create']) ? $data['time_create'] : null;

        $this->time_update = !empty($data['time_update']) ? $data['time_update'] : null;

        $this->title  = !empty($data['title']) ? $data['title'] : null;

        $this->preview  = !empty($data['preview']) ? $data['preview'] : null;

        $this->body_text  = !empty($data['body_text']) ? $data['body_text'] : null;

        $this->publish  = !empty($data['publish']) ? $data['publish'] : null;
    }
}