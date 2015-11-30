<?php

/*
 * This file is part of the qandidate-labs/qandidate-toggle-bundle package.
 *
 * (c) Qandidate.com <opensource@qandidate.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Qandidate\Bundle\ToggleBundle\Twig;

use Qandidate\Toggle\ContextFactory;
use Qandidate\Toggle\ToggleManager;
use Twig_Extension;

class ToggleTwigExtension extends Twig_Extension
{
    private $contextFactory;
    private $toggleManager;

    public function __construct(ToggleManager $toggleManager, ContextFactory $contextFactory)
    {
        $this->toggleManager  = $toggleManager;
        $this->contextFactory = $contextFactory;
    }

    /**
     * @param string $name
     *
     * @return boolean
     */
    public function is_active($name)
    {
        return $this->toggleManager->active($name, $this->contextFactory->createContext());
    }

    /**
     * {@inheritDoc}
     */
    public function getFunctions()
    {
        return array(
            'is_active' => new \Twig_SimpleFunction('is_active', array($this, 'is_active')),
        );
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'qandidate_toggle_twig_extension';
    }
}
