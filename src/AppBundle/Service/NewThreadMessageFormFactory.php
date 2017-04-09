<?php

namespace AppBundle\Service;

use Symfony\Component\Form\FormInterface;
use FOS\MessageBundle\FormFactory\AbstractMessageFormFactory;

/**
 * Instanciates message forms.
 *
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 */
class NewThreadMessageFormFactory extends AbstractMessageFormFactory
{
    /**
     * Creates a new thread message.
     *
     * @return FormInterface
     */
    public function create()
    {
//        dump($this);die;
//        return $this->formFactory->createNamed($this->formName, $this->formType, $this->createModelInstance());
        return $this->
            formFactory->createNamed($this->formName, 'AppBundle\Service\NewThreadMessageFormType', $this->createModelInstance());
    }
}
