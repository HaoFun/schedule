<?php

namespace App\Observers\Traits;

trait MakeRelationDataTrait
{
    protected $contentFields = ['content', 'created_by', 'updated_by'];
    protected $fileFields = ['file_name', 'file_path', 'created_by', 'updated_by'];
    protected $content = [];
    protected $file = [];
    protected $owner;
    protected $manager = [];
    protected $assignee = [];

    public function makeOwner($model, $attribute)
    {
        $this->setOwnerType($attribute);
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

    public function getFileList()
    {
        return $this->file;
    }

    public function getContentList()
    {
        return $this->content;
    }

    public function setOwnerType($attribute)
    {
        $this->owner = $attribute;
    }

    public function getOwnerList()
    {
        $owner = $this->owner;
        return $this->$owner;
    }

    public function getMorphDirty()
    {
        $result = [];
        $fileList = $this->getFileList();
        $contentList = $this->getContentList();
        $owner = $this->owner;
        $ownerList = $this->getOwnerList();
        count($fileList) ? $result['file'] = $fileList : null;
        count($contentList) ? $result['content'] = $contentList : null;
        count($ownerList) ? $result[$owner] = $ownerList : null;
        return $result;
    }
}