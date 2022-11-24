<?php

namespace Ibnfaroukroqay\Dynamics;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
//use VendorName\Skeleton\Commands\SkeletonCommand;

class DynamicsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('dynamics')
            ->hasConfigFile()
//            ->hasCommand(SkeletonCommand::class)
//            ->hasViews()
//            ->hasMigration('create_skeleton_table')
            ;
    }
}
