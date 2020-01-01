<?php

namespace Neko\Twig;
use \Twig\Loader\LoaderInterface;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use Closure;

class Twig {
    
    /**
     * Create a new Blade Factory instance
     *
     * @param array $view_paths
     * @param mixed $view_cache_path
     */
    public function __construct(array $view_paths, $view_cache_path = null) 
    {
        echo "loaded twig";
        $loader = new \Twig\Loader\FilesystemLoader($view_paths);
        $twig = new \Twig\Environment($loader, [
            'cache' => false,
            'debug' => true
        ]);
        //$view_cache_path,
        $this->twig = $twig;
/*
        $this->register("twig", function() use ($view_cache_path) {
      		if ( ! is_dir($view_cache_path)) {
	        	mkdir($view_cache_path, 0777, true);
            }

           // $twig = new BladeCompiler(new Filesystem, $view_cache_path);
            //return new CompilerEngine($twig);
        });
*/
        //parent::__construct($resolver, $finder, $dispatcher);
    }

    /**
     * Shortcut for extending directive
     *
     * @param String $directive
     * @param Closure $compiler
     */
    public function directive($directive, Closure $compiler)
    {
    	return $this->getCompiler()->directive($directive, $compiler);
    }

    /**
     * Shortcut for getting BladeCompiler
     *
     * @return Illuminate\View\Compilers\BladeCompiler
     */
    public function getCompiler()
    {
    	return $this->getEngineResolver()->resolve('twig')->getCompiler();
    }

    /**
     * Shortcut render a view file into string
     *
     * @param string $file
     * @param array $data
     * @return string rendered view
     */
    public function render($file, array $data = array())
    {
        return $this->twig->render($file, $data);
    	//return $this->make($file, $data)->render();
    }

}
