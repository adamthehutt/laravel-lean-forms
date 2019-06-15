<?php
declare(strict_types=1);

namespace AdamTheHutt\LeanForms\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

class FormMakeCommand extends GeneratorCommand
{
    /** @var string  */
    protected $name = 'make:lean-form';

    /** @var string  */
    protected $description = 'Create a lean form class';

    /** @var string  */
    protected $type = 'Form';

    /** @var FormGenerator  */
    private $formGenerator;

    public function __construct(Filesystem $files, FormGenerator $formGenerator)
    {
        parent::__construct($files);
        $this->formGenerator = $formGenerator;
    }
    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('name', InputArgument::REQUIRED, 'Fully qualified name of the desired form class.'),
        );
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $formGenerator = $this->formGenerator;
        return str_replace(
            '{{class}}',
            $formGenerator->getClassInfo($name)->className,
            $stub
        );
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $namespace = $this->formGenerator->getClassInfo($name)->namespace;
        $stub = str_replace('{{namespace}}', $namespace, $stub);
        return $this;
    }
    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/form-class-template.stub';
    }

    /**
     * @inheritdoc
     */
    protected function getPath($name)
    {
        $path = str_replace('\\', '/', $this->formGenerator->getClassInfo($name)->namespace);
        $path = preg_replace('/^App/', 'app', $path);

        return join('/', [
            $this->laravel->basePath(),
            trim($path, '/'),
            $this->formGenerator->getClassInfo($name)->className.'.php'
        ]);
    }
}
