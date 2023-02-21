<?php

namespace App\Services;

use App\Site;
use Tapp\Airtable\Api\AirtableApiClient;

class ModelService
{
    protected $airtableApi;

    public function __construct(Site $site)
    {
        $this->airtableApi = new AirtableApiClient($site->base_id, 'models', $site->access_key);
    }

    public function fetchAllModels(): array
    {
        try {
            $modelArr = $this->airtableApi->getAllPages(20000)->toArray();
            $pivotArr = $this->airtableApi->setTable('model_model')->getAllPages(20000)->toArray();
        } catch (\Exception $e) {
            return [];
        }


        return $this->buildTree($modelArr, $pivotArr);
    }

    private function setChild(array $modelArr, array $pivotArr, array $element): array
    {
        if (isset($element['fields']['children'])) {
            foreach ($element['fields']['children'] as $key => $relationship_id) {
                $child_id = '';
                foreach ($pivotArr as $relationship) {
                    if ($relationship['id'] === $relationship_id) {
                        $child_id = $relationship['fields']['number'][0];
                        break;
                    }
                }
                foreach ($modelArr as $node) {
                    if ($node['id'] === $child_id) {
                        $node = $this->setChild($modelArr, $pivotArr, $node);
                        $element['fields']['children'][$key] = $node;
                        break;
                    }
                }
            }
        }

        return array_merge(['id' => $element['id']], $element['fields']);
    }

    private function buildTree(array $modelArr, array $pivotArr): array
    {
        $tree = [];
        foreach ($modelArr as $node) {
            if (!isset($node['fields']['parents'])) {
                $tree[] = $this->setChild($modelArr, $pivotArr, $node);
            }
        }

        return $tree;
    }
}
