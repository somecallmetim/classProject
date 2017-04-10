<?php
// src/AppBundle/Security/ItemPostVoter.php
namespace AppBundle\Security;

use AppBundle\Entity\ItemPost;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class PostVoter extends Voter
{
    // these strings are just invented: you can use anything
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE = 'delete';

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    protected function supports($attribute, $subject)
    {

        // if the attribute isn't one we support, return false
        if (!in_array($attribute, array(self::VIEW, self::EDIT, self::DELETE))) {
            return false;
        }

        // only vote on ItemPost objects inside this voter
        if (!$subject instanceof ItemPost) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {

        $user = $token->getUser();

        if (!$user instanceof User) {
            // the user must be logged in; if not, deny access
            return false;
        }

        // you know $subject is a ItemPost object, thanks to supports
        /** @var ItemPost $itemPost */
        $itemPost = $subject;



        switch ($attribute) {
            case self::VIEW:
                return $this->canView($itemPost, $user);
            case self::EDIT:
                return $this->canEdit($itemPost, $user);
            case self::DELETE:
                return $this->canDelete($itemPost, $user, $token);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(ItemPost $itemPost, User $user)
    {
        return true;
    }

    private function canEdit(ItemPost $itemPost, User $user)
    {
        // this assumes that the data object has a getUser() method
        // to get the entity of the user who owns this data object
        return $user === $itemPost->getUser();
    }

    private function canDelete(ItemPost $itemPost, User $user, TokenInterface $token){
        // ROLE_SUPER_ADMIN can do anything! The power!
        if ($this->decisionManager->decide($token, array('ROLE_SUPER_ADMIN')) ||
            $this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        return $user === $itemPost->getUser();
    }
}