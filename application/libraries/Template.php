<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class Template {

	private $viewFactory;

	public function __construct()
	{
		$pathsToTemplates = [
			APPPATH . 'views'
		];
		$pathToCompiledTemplates = APPPATH . 'cache/views';

		$filesystem      = new Filesystem;
		$eventDispatcher = new Dispatcher(new Container);
		$viewResolver    = new EngineResolver;
		$bladeCompiler   = new BladeCompiler($filesystem, $pathToCompiledTemplates);

		$viewResolver->register('blade', function () use ($bladeCompiler) {
		    return new CompilerEngine($bladeCompiler);
		});
		$viewResolver->register('php', function () {
		    return new PhpEngine;
		});

		$viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);
		$this->viewFactory = new Factory($viewResolver, $viewFinder, $eventDispatcher);
	}

	public function view($path, $data = [])
	{
		echo $this->viewFactory->make($path, $data)->render();
	}

	public function render($path, $data = [])
	{
		return $this->viewFactory->make($path, $data)->render();
	}
}
