<?php

namespace blogCms\View;

use Illuminate\View\FileViewFinder;

class ThemeViewFinder extends FileViewFinder
{
    protected $activeTheme;
    
    protected $basePath;

    /**
     * @param $path
     */
    public function setBasePath($path)
    {
        $this->basePath = $path;
    }

    /**
     * @param $theme
     */
    public function setActiveTheme($theme)
    {
        $this->activeTheme = $theme;
        
        array_unshift($this->paths, $this->basePath . '/' . $theme . '/views');
    }
}
