<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class LeanFormsManager
{
    /**
     * @param  string      $identifier
     * @param  Model|null  $model
     *
     * @return AbstractForm
     * @throws \Exception
     */
    public function __invoke(string $identifier, Model $model = null): AbstractForm
    {
        return $this->form($identifier, $model);
    }

    /**
     * @param  string      $identifier
     * @param  Model|null  $model
     *
     * @return AbstractForm
     * @throws \Exception
     */
    public function form(string $identifier, Model $model = null): AbstractForm
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
