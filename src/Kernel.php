<?php

namespace GlpiPlugin\API;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel {
   use MicroKernelTrait;

   private const CONFIG_EXTS = '.{php,xml,yaml,yml}';

   public function getProjectDir(): string
   {
      return \dirname(__DIR__);
   }

   public function getCharset()
   {
      return 'UTF-8';
   }

   protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
   {

      $confDir = $this->getProjectDir() . '/config';

      // always load all files in /config/packages/
      $loader->load($confDir . '/packages/*' . self::CONFIG_EXTS, 'glob');

      // then, if available, load the files in the specific environment directory
      if (is_dir($confDir . '/packages/' . $this->environment)) {
         $loader->load($confDir . '/packages/' . $this->environment . '/**/*' . self::CONFIG_EXTS, 'glob');
      }

      // load a special services.(yaml/xml/php) and, if available, services_ENVIRONMENT.(yaml/xml/php) file
      $loader->load($confDir . '/services' . self::CONFIG_EXTS, 'glob');
      $loader->load($confDir . '/services_' . $this->environment . self::CONFIG_EXTS, 'glob');
   }

   protected function configureRoutes(RoutingConfigurator $routes)
   {
      $confDir = $this->getProjectDir() . '/config';
      $routes->import($confDir . '/{routes}/' . $this->environment . '/*' . self::CONFIG_EXTS, 'glob', false);
      $routes->import($confDir . '/{routes}/*' . self::CONFIG_EXTS, 'glob', false);
      $routes->import($confDir . '/{routes}' . self::CONFIG_EXTS, 'glob', false);
   }
}