<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class LeanFormsManager
{
    public function form($identifier, Model $model = null): AbstractForm
    {
        $relativeName = Str::studly(str_replace(".", "\\", $identifier));
        foreach (Config::get("lean-forms.namespaces") as $ns) {
            $candidate = $ns . '\\' . $relativeName;
            if (class_exists($candidate)) {
                return new $candidate($model);
            }
        }

        throw new \Exception("Could not find form $identifier");
    }
}
