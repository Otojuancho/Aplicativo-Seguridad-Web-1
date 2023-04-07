<?php
namespace Composer; use Composer\Autoload\ClassLoader; use Composer\Semver\VersionParser; class InstalledVersions { private static $installed; private static $canGetVendors; private static $installedByVendor = array(); public static function getInstalledPackages() { $sp1ba736 = array(); foreach (self::sp47b541() as $sp2c1d86) { $sp1ba736[] = array_keys($sp2c1d86['versions']); } if (1 === \count($sp1ba736)) { return $sp1ba736[0]; } return array_keys(array_flip(\call_user_func_array('array_merge', $sp1ba736))); } public static function getInstalledPackagesByType($sp5d76a7) { $spc63ebe = array(); foreach (self::sp47b541() as $sp2c1d86) { foreach ($sp2c1d86['versions'] as $spd51bb7 => $sp944c90) { if (isset($sp944c90['type']) && $sp944c90['type'] === $sp5d76a7) { $spc63ebe[] = $spd51bb7; } } } return $spc63ebe; } public static function isInstalled($sp8d84b8, $sp8558ea = true) { foreach (self::sp47b541() as $sp2c1d86) { if (isset($sp2c1d86['versions'][$sp8d84b8])) { return $sp8558ea || empty($sp2c1d86['versions'][$sp8d84b8]['dev_requirement']); } } return false; } public static function satisfies(VersionParser $spb63ec4, $sp8d84b8, $spacdf46) { $spacdf46 = $spb63ec4->parseConstraints($spacdf46); $spcfc559 = $spb63ec4->parseConstraints(self::getVersionRanges($sp8d84b8)); return $spcfc559->matches($spacdf46); } public static function getVersionRanges($sp8d84b8) { foreach (self::sp47b541() as $sp2c1d86) { if (!isset($sp2c1d86['versions'][$sp8d84b8])) { continue; } $sp3c7d7d = array(); if (isset($sp2c1d86['versions'][$sp8d84b8]['pretty_version'])) { $sp3c7d7d[] = $sp2c1d86['versions'][$sp8d84b8]['pretty_version']; } if (array_key_exists('aliases', $sp2c1d86['versions'][$sp8d84b8])) { $sp3c7d7d = array_merge($sp3c7d7d, $sp2c1d86['versions'][$sp8d84b8]['aliases']); } if (array_key_exists('replaced', $sp2c1d86['versions'][$sp8d84b8])) { $sp3c7d7d = array_merge($sp3c7d7d, $sp2c1d86['versions'][$sp8d84b8]['replaced']); } if (array_key_exists('provided', $sp2c1d86['versions'][$sp8d84b8])) { $sp3c7d7d = array_merge($sp3c7d7d, $sp2c1d86['versions'][$sp8d84b8]['provided']); } return implode(' || ', $sp3c7d7d); } throw new \OutOfBoundsException('Package "' . $sp8d84b8 . '" is not installed'); } public static function getVersion($sp8d84b8) { foreach (self::sp47b541() as $sp2c1d86) { if (!isset($sp2c1d86['versions'][$sp8d84b8])) { continue; } if (!isset($sp2c1d86['versions'][$sp8d84b8]['version'])) { return null; } return $sp2c1d86['versions'][$sp8d84b8]['version']; } throw new \OutOfBoundsException('Package "' . $sp8d84b8 . '" is not installed'); } public static function getPrettyVersion($sp8d84b8) { foreach (self::sp47b541() as $sp2c1d86) { if (!isset($sp2c1d86['versions'][$sp8d84b8])) { continue; } if (!isset($sp2c1d86['versions'][$sp8d84b8]['pretty_version'])) { return null; } return $sp2c1d86['versions'][$sp8d84b8]['pretty_version']; } throw new \OutOfBoundsException('Package "' . $sp8d84b8 . '" is not installed'); } public static function getReference($sp8d84b8) { foreach (self::sp47b541() as $sp2c1d86) { if (!isset($sp2c1d86['versions'][$sp8d84b8])) { continue; } if (!isset($sp2c1d86['versions'][$sp8d84b8]['reference'])) { return null; } return $sp2c1d86['versions'][$sp8d84b8]['reference']; } throw new \OutOfBoundsException('Package "' . $sp8d84b8 . '" is not installed'); } public static function getInstallPath($sp8d84b8) { foreach (self::sp47b541() as $sp2c1d86) { if (!isset($sp2c1d86['versions'][$sp8d84b8])) { continue; } return isset($sp2c1d86['versions'][$sp8d84b8]['install_path']) ? $sp2c1d86['versions'][$sp8d84b8]['install_path'] : null; } throw new \OutOfBoundsException('Package "' . $sp8d84b8 . '" is not installed'); } public static function getRootPackage() { $sp2c1d86 = self::sp47b541(); return $sp2c1d86[0]['root']; } public static function getRawData() { @trigger_error('getRawData only returns the first dataset loaded, which may not be what you expect. Use getAllRawData() instead which returns all datasets for all autoloaders present in the process.', E_USER_DEPRECATED); if (null === self::$installed) { if (substr(__DIR__, -8, 1) !== 'C') { self::$installed = (include __DIR__ . '/installed.php'); } else { self::$installed = array(); } } return self::$installed; } public static function getAllRawData() { return self::sp47b541(); } public static function reload($spee103d) { self::$installed = $spee103d; self::$installedByVendor = array(); } private static function sp47b541() { if (null === self::$canGetVendors) { self::$canGetVendors = method_exists('Composer\\Autoload\\ClassLoader', 'getRegisteredLoaders'); } $sp2c1d86 = array(); if (self::$canGetVendors) { foreach (ClassLoader::getRegisteredLoaders() as $sp87105f => $sp76e577) { if (isset(self::$installedByVendor[$sp87105f])) { $sp2c1d86[] = self::$installedByVendor[$sp87105f]; } elseif (is_file($sp87105f . '/composer/installed.php')) { $sp2c1d86[] = self::$installedByVendor[$sp87105f] = (require $sp87105f . '/composer/installed.php'); if (null === self::$installed && strtr($sp87105f . '/composer', '\\', '/') === strtr(__DIR__, '\\', '/')) { self::$installed = $sp2c1d86[count($sp2c1d86) - 1]; } } } } if (null === self::$installed) { if (substr(__DIR__, -8, 1) !== 'C') { self::$installed = (require __DIR__ . '/installed.php'); } else { self::$installed = array(); } } $sp2c1d86[] = self::$installed; return $sp2c1d86; } }