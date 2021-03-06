<?php
namespace MaikeNegreiros;

class PageAssembler
{
    public function build(string $templatePath, string $fileName): bool
    {
        $path = substr($templatePath, 0, strripos($templatePath,"/") + 1);
        $templateString = file_get_contents($templatePath);

        $includes = $this->getIncludes($templateString);

        $components = $this->getComponents($includes, $path);

        $newFile = str_replace($includes, $components, $templateString);

        $this->createDirectoriesIfDontExist($fileName);

        if(file_put_contents($fileName, $newFile)) return true;
        return false;
    }

    private function createDirectoriesIfDontExist(string $path): void
    {
        $directory = substr($path,0,strripos($path,"/"));
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
    }

    private function getIncludes(string $templateString): array
    {
        $regex = '/@include (\.{0,2}\/{1}[\w|\w-\w]+)*\.html{1}/';
        preg_match_all($regex, $templateString, $matchs);
        return $matchs[0];
    }

    private function getComponents(array $includes, string $path): array
    {
        $components = [];
        foreach ($includes as $componentPath) {
            $components[] = file_get_contents($path.substr($componentPath, 9));
        }
        return $components;
    }
}
