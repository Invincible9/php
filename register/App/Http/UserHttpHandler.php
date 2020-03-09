<?php

namespace App\Http;

use App\Data\ErrorDTO;
use App\Data\LegalEntityDTO;
use App\Data\PhysicalEntityDTO;
use App\Data\UserDTO;
use App\Service\LegalEntityServiceInterface;
use App\Service\PhysicalEntityServiceInterface;
use App\Service\TypeEntityServiceInterface;
use App\Service\UserServiceInterface;
use Core\DataBinderInterface;
use Core\TemplateInterface;

class UserHttpHandler extends UserHttpHandlerAbstract
{
    private $userService;
    private $physicalEntityService;
    private $legalEntityService;
    private $typeEntityService;

    public function __construct(
        TemplateInterface $template,
        DataBinderInterface $dataBinder,
        UserServiceInterface $userService,
        PhysicalEntityServiceInterface $physicalEntityService,
        LegalEntityServiceInterface $legalEntityService,
        TypeEntityServiceInterface $typeEntityService)
    {
        parent::__construct($template, $dataBinder);
        $this->userService = $userService;
        $this->physicalEntityService = $physicalEntityService;
        $this->legalEntityService = $legalEntityService;
        $this->typeEntityService = $typeEntityService;
    }

    public function index()
    {
        $this->render("home/index");
    }

    public function profile()
    {
        if (!$this->userService->isLogged()) {
            $this->redirect("login.php");
        }
        $user = $this->userService->currentUser()->getUsername();
        echo "<b><spam style='color: green'>Welcome <span style='color: red'>$user</span> you successfully logged into our platform!!!</span></b>";
    }

    public function register(array $formData = [])
    {
        if (isset($formData['register'])) {
            $this->handleRegisterProcess($formData);
        } else {
            $this->render("users/register");
        }
    }

    private function handleRegisterProcess($formData)
    {
        /** @var LegalEntityDTO $legalEntity */
        $legalEntity = null;
        /** @var PhysicalEntityDTO $physicalEntity */
        $physicalEntity = null;
        $_SESSION['type'] = $formData['type'];
        $isLegalEntity =  $formData['type'] == 2 ? true : false;
        try {
            !$isLegalEntity ?
                $physicalEntity = $this->dataBinder->bind($formData, PhysicalEntityDTO::class) :
                $legalEntity = $this->dataBinder->bind($formData, LegalEntityDTO::class);
            /** @var UserDTO $user */
            $user = $this->dataBinder->bind($formData, UserDTO::class);
            $typeEntity = $this->typeEntityService->getOneById(intval($formData['type']));
            $user->setTypeEntity($typeEntity);
            /** @var UserServiceInterface $userService */
            $insertedId = $this->userService->register($user, $formData['confirm_password']);
            $user->setId($insertedId);
            !$isLegalEntity ?
                $physicalEntity->setUser($user) :
                $legalEntity->setUser($user);
            !$isLegalEntity ?
                $this->physicalEntityService->register($physicalEntity) :
                $this->legalEntityService->register($legalEntity);

            $_SESSION['username'] = $user->getUsername();
            $this->redirect("login.php");
        } catch (\Exception $ex) {
            $errorDTO = $this->dataBinder->bind($formData, ErrorDTO::class);

            $this->render("users/register", $errorDTO,
                [$ex->getMessage()]);
        }
    }

    public function login(array $formData = [])
    {
        $username = "";
        if (isset($formData['login'])) {
            $this->handleLoginProcess($formData);
        } else {
            if(isset($_SESSION['username'])){
                $username = $_SESSION['username'];
            }
            $this->render("users/login",
                $username === "" ? "" : $username);
        }
    }

    private function handleLoginProcess($formData)
    {
        try {
            /** @var UserServiceInterface $userService */
            $user = $this->userService->login($formData['username'], $formData['password']);

            if (null !== $user) {
                $_SESSION['id'] = $user->getId();
                $this->redirect("profile.php");
            }
        } catch (\Exception $ex) {
            $currentUser = $this->dataBinder->bind($formData, UserDTO::class);
            $this->render("users/login", null,
                [$ex->getMessage()]);
        }
    }

}