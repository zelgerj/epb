<?php

/**
 * AppserverIo\Psr\EnterpriseBeans\Annotations\Resource
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category   Appserver
 * @package    Psr
 * @subpackage EnterpriseBeans
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io-psr/epb
 * @link       http://www.appserver.io
 */

namespace AppserverIo\Psr\EnterpriseBeans\Annotations;

use AppserverIo\Lang\Reflection\ReflectionAnnotation;

/**
 * Annotation implementation representing a @Resource annotation on a property.
 *
 * @category   Appserver
 * @package    Psr
 * @subpackage EnterpriseBeans
 * @author     Tim Wagner <tw@appserver.io>
 * @copyright  2014 TechDivision GmbH <info@appserver.io>
 * @license    http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link       https://github.com/appserver-io-psr/epb
 * @link       http://www.appserver.io
 */
class Resource extends AbstractBeanAnnotation
{

    /**
     * The annotation for method, a bean has to be injected.
     *
     * @var string
     */
    const ANNOTATION = 'Resource';

    /**
     * This method returns the class name as
     * a string.
     *
     * @return string
     */
    public static function __getClass()
    {
        return __CLASS__;
    }

    /**
     * Returns the value of the bean interface attribute.
     *
     * @return string The annotations bean interface attribute
     */
    public function getBeanInterface()
    {
        return $this->values[AnnotationKeys::BEAN_INTERFACE];
    }

    /**
     * Returns the value of the bean name attribute.
     *
     * @return string The annotations bean nName attribute
     */
    public function getBeanName()
    {
        return $this->values[AnnotationKeys::BEAN_NAME];
    }

    /**
     * Helper method that returns the naming context lookup name specified
     * as annotation attribute.
     *
     * The following order is use to return the lookup name:
     *
     * 1. The name attribute
     * 2. The beanName attribute
     * 3. The mappedName attribute
     *
     * @return string The lookup name used to resolve the enterprise bean reference
     */
    public function getLookupName()
    {

        // first try to use @Resource(name="MyResource")
        if ($identifier = $this->getName()) {
            return $identifier;
        }

        // second try to use @Resource(beanName="MyResource")
        if ($identifier = $this->getBeanName()) {
            return $identifier;
        }

        // third try to use @Resource(mappedName="MyResource")
        if ($identifier = $this->getMappedName()) {
            return $identifier;
        }
    }
}
