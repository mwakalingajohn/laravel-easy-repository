<?php

namespace Mwakalingajohn\LaravelEasyRepository\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Mwakalingajohn\LaravelEasyRepository\AssistCommand;
use Mwakalingajohn\LaravelEasyRepository\CreateFile;

class MakeRepository extends Command
{
    use AssistCommand;

    public $signature = 'make:repository
        {name : The name of the repository }
        {--other : If not put, it will create an eloquent repository}?
        {--service : Create a service along with the repository}?';

    public $description = 'Create a new repository class';

    /**
     * Handle the command
     *
     * @return void
     */
    public function handle()
    {
        $name = str_replace(config("easy-repository.repository_suffix"), "", $this->argument("name"));
        $name = Str::studly($name);

        $other = $this->option("other");

        $className = Str::studly($name);

        $this->checkIfRequiredDirectoriesExist();

        // First we create the repoisitory interface in the interfaces directory
        // This will be implemented by the interface class
        $this->createRepositoryInterface($className);


        // Second we create the repoisitory directory
        // This will be implement by the interface class
        $this->createRepository($className, ! $other);

        if ($this->option('service')) {
            $this->createService();
        }
    }

    /**
     * Create service for the repository
     *
     * @return void
     */
    private function createService()
    {
        $name = str_replace(config("easy-repository.repository_suffix"), "", $this->argument("name"));
        $name = Str::studly($name);

        $this->call("make:service", [
            "name" => $name,
        ]);
    }

    /**
     * Create the repository interface
     *
     * @param string $className
     * @return void
     */
    public function createRepositoryInterface(string $className)
    {
        $repositoryInterfaceNamespace = config("easy-repository.repository_namespace") . "\Interfaces";
        $repositoryInterfaceName = $className . config("easy-repository.repository_interface_suffix");
        $stubProperties = [
            "{namespace}" => $repositoryInterfaceNamespace,
            "{repositoryInterfaceName}" => $repositoryInterfaceName,
        ];

        $repositoryInterfacePath = $this->getRepositoryInterfacePath($className);

        new CreateFile(
            $stubProperties,
            $repositoryInterfacePath,
            __DIR__ . "/stubs/repository-interface.stub"
        );

        $this->line("<info>Created $className repository interface:</info> " . $repositoryInterfaceName);

        return $repositoryInterfaceNamespace . "\\" . $className;
    }

    /**
     * Create repository
     *
     * @param string $className
     * @return void
     */
    private function createRepository(string $className, $isDefault = true)
    {
        $repositoryNamespace = $isDefault
            ? config("easy-repository.repository_namespace") . "\\" . $this->getDefaultImplementation()
            : config("easy-repository.repository_namespace");

        $repositoryName = $className . config("easy-repository.repository_suffix");
        $stubProperties = [
            "{namespace}" => $repositoryNamespace,
            "{repositoryName}" => $repositoryName,
            "{repositoryInterfaceNamespace}" => $this->getRepositoryInterfaceNamespace($className),
            "{repositoryInterfaceName}" => $className . "RepositoryInterface",
        ];

        $stubName = $isDefault ? "eloquent-repository.stub" : "custom-repository.stub";
        $repositoryPath = $this->getRepositoryPath($className, $isDefault);
        new CreateFile(
            $stubProperties,
            $repositoryPath,
            __DIR__ . "/stubs/$stubName"
        );
        $this->line("<info>Created $className repository:</info> " . $repositoryName);

        return $repositoryNamespace . "\\" . $className;
    }

    /**
     * Get repository interface namespace
     *
     * @return string
     */
    private function getRepositoryInterfaceNamespace(string $className)
    {
        return config("easy-repository.repository_namespace") . "\Interfaces";
    }

    /**
     * Get repository interface path
     *
     * @return string
     */
    private function getRepositoryInterfacePath($className)
    {
        return $this->appPath() . "/" .
            config("easy-repository.repository_directory") .
            "/Interfaces/$className" . config("easy-repository.repository_interface_suffix") . ".php";
    }

    /**
     * Get repository path
     *
     * @return string
     */
    private function getRepositoryPath($className, $isDefault)
    {
        $path = $isDefault
            ? "/" . $this->getDefaultImplementation() . "/$className" . "Repository.php"
            : "/Other/$className" .  config("easy-repository.repository_suffix") . ".php";

        return $this->appPath() . "/" .
            config("easy-repository.repository_directory") . $path;
    }

    /**
     * Check to make sure if all required directories are available
     *
     * @return void
     */
    private function checkIfRequiredDirectoriesExist()
    {
        $this->ensureDirectoryExists(config("easy-repository.repository_directory"));
        $this->ensureDirectoryExists(config("easy-repository.repository_directory") . "/Interfaces");
        $this->ensureDirectoryExists(config("easy-repository.repository_directory") . "/" . $this->getDefaultImplementation());
    }

    /**
     * Get default repository implementation
     *
     * @return string
     */
    private function getDefaultImplementation()
    {
        return config("easy-repository.default_repository_implementation");
    }
}
