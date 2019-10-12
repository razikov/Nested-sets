<?php

namespace app\helpers;

/**
 * Description of Tree
 *
 * @author aleksey
 */
class Tree
{
    
    /*
     * Принимает plain массив и набор ключей из этого массива и формирует вложенную структуру
     */
    public function createTree(array $keys, array $data) : array
    {
        $result = [];
        foreach ($data as $row) {
            $path = $this->getPath($keys, $row);
            \yii\helpers\ArrayHelper::setValue($result, $path, $row);
        }
        return $result;
    }
    
//    public function createIndex($keys, $row)
//    {
//        if (empty($keys)) {
//            return $row;
//        }
//        $key = array_shift($keys);
//        $data[$row[$key]] = $this->createIndex($keys, $row);
//        return $data;
//    }
    
    private function getPath($keys, $row)
    {
        $result = [];
        $countKeys = count($keys);
        foreach($keys as $key) {
            if ($countKeys > 0) {
                $result[] = 'rows';
            }
            $result[] = $row[$key];
            $countKeys--;
        }
        return $result;
    }
    
//    public function getUniqValues($key, $data)
//    {
//        return array_unique(array_column($data, $key));
//    }
    
    public function getTreeSum($key, $data)
    {
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
        if (array_key_exists('rows', $data)) {
            return array_sum(
                array_map(
                    function ($item) use ($key) {
                        return static::getTreeSum($key, $item);
                    },
                    $data['rows']
                )
            );
        }

        return null;
    }
    
    public function getTreeCount($key, $data)
    {
        if (array_key_exists($key, $data)) {
            return 1;
        }
        if (array_key_exists('rows', $data)) {
            return array_sum(
                array_map(
                    function ($item) use ($key) {
                        return static::getTreeCount($key, $item);
                    },
                    $data['rows']
                )
            );
        }

        return 0;
    }
    
    public function getTreeAvg($key, $data)
    {
        $count = static::getTreeCount($key, $data);
        if (!$count) {
            return 0;
        }
        
        return $this->getTreeSum($key, $data) / $count;
    }
    
    public function getMaterializedPathsTree($treeData, $key = 'root')
    {
        $paths = [];
        
        // Если у элемента есть потомки "rows", то это ветка и за ним есть листья
        // Если же нет, то это лист
        if (!isset($treeData['rows'])) {
            return [$key];
        } else {
            $paths[] = (string)$key;
            foreach($treeData['rows'] as $keyNew => $item) {
                $paths = array_merge($paths, $this->getMaterializedPathsTree($item, $key.'.'.$keyNew));
            }
        }
        return $paths;
    }
    
    public function getBranchPath($key)
    {
        $arrKeys = array_slice(explode('.', $key), 1);
        $result = [];
        foreach($arrKeys as $key) {
            $result[] = 'rows';
            $result[] = $key;
        }
        return $result;
    }
    
    /**
     * Функция из удаляемого кода, проверить нужна ли...
     * @param type $parent_id
     * @param type $lvl
     */
    function render_tree($parent_id, $lvl) {
        //$arr = array('parent'=>$parent_id);
        //$arr = Массив строк для записи в эксель (норма,работа/часы/стиль)
        if (isset($this->tree_norms[$parent_id])) {
            foreach ($this->tree_norms[$parent_id] as $norm) {
                //$arr[] = array($norm->getId(), $norm->getHours(), 'Z');
                $this->arr[] = array($norm->getPn().' '.$norm->getName(), $norm->getDescription(), $norm->getHours(), 'lvl'.$lvl);
                if (isset($this->tree_jobs[$norm->getId()])) {
                    foreach($this->tree_jobs[$norm->getId()] as $job) {
                        //$arr[] = array($job->getId(), $job->getSumma(), 'J');
                        $this->arr[] = array($job->getDescription(), '', $job->getSumma(), 'Job');
                    }
                }
                //$arr[] = $this->render_tree($norm->getId(), $arr);
                $lvl++;
                $this->render_tree($norm->getId(), $lvl);
                $lvl--;
            }
        } elseif (isset($this->tree_jobs[$parent_id]) and ($this->norms[$parent_id]->getIdParent() == 0)) {
            //Родитель этой нормы 0
            //
            //Для случаев, когда в корневой норме работы
            foreach($this->tree_jobs[$parent_id] as $job) {
                //$arr[] = array($job->getId(), $job->getSumma(), 'J');
                $this->arr[] = array($job->getDescription(), '', $job->getSumma(), 'Job');
            }
        }
        //return $arr;
    }
    
}