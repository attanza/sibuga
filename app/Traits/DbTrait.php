<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait DbTrait
{
    public function getPaginated($request, $modelName, $searchable = [], $relations = [])
    {
        extract($this->getQueries($request));
        $search = $request->query('search') ? $request->query('search') : '';

        $redisKey = $this->getRedisKey($this->getQueries($request));
        if ($search == '') {
            $data = Cache::tags([$modelName])->get($redisKey);
            if ($data != null) {
                return json_decode($data);
            }
        }

        $Model = $this->getModel($modelName);

        $data = $Model::where(function ($query) use ($search, $searchable, $relations, $filterBy, $filterValue, $pictureableId, $pictureableType) {
            if ($search !== '' && count($searchable) > 0) {
                $query->where(array_shift($searchable), 'like', "%$search%");
                foreach ($searchable as $s) {
                    $query->orWhere($s, 'like', "%$search%");
                }
                if (count($relations) > 0) {
                    foreach ($relations as $r) {
                        $query->orWhereHas($r, function ($query2) use ($search) {
                            $query2->where('name', 'like', "%$search%");
                        });
                    }
                }
            }

            if (isset($filterBy) && isset($filterValue)) {
                $query->where($filterBy, $filterValue);
            }

            if (isset($pictureableId) && isset($pictureableType)) {
                $query->where('pictureable_id', $pictureableId);
                $query->where('pictureable_type', $pictureableType);
            }
        })->orderBy($sortBy, $sortMode)
            ->paginate($perPage);
        if ($search == '') {
            Cache::tags([$modelName])->put($redisKey, json_encode($data->toJSON()), now()->addMinutes(30));
        }

        return $data->toJSON();
    }

    public function noPaginate($request, $modelName, $searchable = [], $relations = [])
    {
        extract($this->getQueries($request));
        $search = $request->query('search') ? $request->query('search') : '';

        $redisKey = $this->getRedisKey($this->getQueries($request));
        if ($search == '') {
            $data = Cache::tags([$modelName])->get($redisKey);
            if ($data != null) {
                return json_decode($data);
            }
        }
        $Model = $this->getModel($modelName);
        $data = $Model::where(function ($query) use ($searchable, $search, $relations, $pictureableId, $pictureableType, $filterBy, $filterValue) {
            if ($search !== '' && count($searchable) > 0) {
                $query->where($searchable[0], 'like', "%$search%");
                foreach ($searchable as $s) {
                    $query->orWhere($s, 'like', "%$search%");
                }
                if (count($relations) > 0) {
                    foreach ($relations as $r) {
                        $query->orWhereHas($r, function ($q2) use ($search) {
                            $q2->where('name', 'like', "%$search%");
                        });
                    }
                }
            }
            if ($filterBy !== '' && $filterValue !== '') {
                $query->where($filterBy, $filterValue);
            }
            if (isset($pictureableId) && isset($pictureableType)) {
                $query->where('pictureable_type', $pictureableType)
                    ->where('pictureable_id', (int) $pictureableId);
            }
        })->orderBy($sortBy, $sortMode)->get();
        if ($search == '') {
            Cache::tags([$modelName])->put($redisKey, json_encode($data->toJSON()), now()->addMinutes(30));
        }

        return $data->toJSON();
    }

    public function dbStore($request, $modelName)
    {
        $Model = $this->getModel($modelName);
        $data = $Model::create($request->all());
        Cache::tags($modelName)->flush();
        return $data;
    }

    public function dbGetById($id, $modelName)
    {
        $Model = $this->getModel($modelName);
        return $Model::findOrFail($id);
    }

    public function dbUpdate($request, $id, $modelName)
    {
        $Model = $this->getModel($modelName);
        $data = $Model::findOrFail($id);
        $data->update($request->all());
        Cache::tags($modelName)->flush();
        return $data;
    }

    public function dbDelete($id, $modelName)
    {
        $Model = $this->getModel($modelName);
        $data = $Model::findOrFail($id);
        $data->delete();
        Cache::tags($modelName)->flush();
        return $data;
    }

    public function getComboData($modelName, $where = [], $redisKey = '', $key = 'name', $orderBy = null, $orderMode = null)
    {
        $Model = $this->getModel($modelName);

        return Cache::remember($modelName . '_Combo_' . $redisKey, now()->addMinutes(30), function () use ($Model, $where, $key, $orderBy, $orderMode) {
            return $Model::select('id', $key)->where(function ($q) use ($where) {
                $q->where($where);
            })->orderBy($orderBy ?? $key, $orderMode ?? 'asc')->get();
        });
    }

    protected function getQueries($request)
    {
        $perPage = $request->query('perPage') ? (int) $request->query('perPage') : 10;
        $page = $request->query('page') ? (int) $request->query('page') : 1;
        $sortBy = $request->query('sortBy') ? $request->query('sortBy') : 'created_at';
        $sortMode = $request->query('sortMode') ? $request->query('sortMode') : 'desc';
        $pictureableId = $request->query('pictureableId');
        $pictureableType = $this->getModel($request->query('pictureableType'));
        $filterBy = $request->query('filterBy');
        $filterValue = $request->query('filterValue');

        return [
            'page' => $page,
            'perPage' => $perPage,
            'sortBy' => $sortBy,
            'sortMode' => $sortMode,
            'pictureableId' => $pictureableId,
            'pictureableType' => $pictureableType,
            'filterBy' => $filterBy,
            'filterValue' => $filterValue,
        ];
    }

    public function getModel($modelName)
    {
        if ($modelName === 'User') {
            return "App\User";
        } else {
            return "App\Models\\$modelName";
        }
    }

    protected function getRedisKey($keys)
    {
        return implode('_', $keys);
    }
}
