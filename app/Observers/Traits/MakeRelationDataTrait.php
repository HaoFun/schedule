<?php

namespace App\Observers\Traits;

trait MakeRelationDataTrait
{
    protected $contentFields = ['content', 'created_by', 'updated_by'];
    protected $fileFields = ['file_name', 'file_path', 'created_by', 'updated_by'];
    protected $content;
    protected $file;
    protected $manager;

    public function makeManager($model, $attribute)
    {
        if (request($attribute)) {
            $this->$attribute = $model->user()->sync(request($attribute));
        }
    }

    public function makeContent($model)
    {
        if (request('content')) {
            $contents = $model->contents()->create(array_only(request()->all(), $this->contentFields));
            $this->content = [$contents->id];
        }
    }

    public function makeFile($model)
    {
        if (request('file')) {
            $this->file = $model->files()->createMany([]);
        }
    }
}