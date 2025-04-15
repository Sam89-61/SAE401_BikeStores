<?php
require __DIR__ . "../../bootstrap.php";

use Entity\Employees;
use Entity\Stores;
use Repository\EmployeeRepository;

class Controller
{
    private $action;
    private $email;
    private $mdp;
    // obligatoire depuis la version 8.2 de PHP
    private $PHPSESSID;
    private $emailE;
    private $mdpE;
    private $emailEC;
    private $mdpEC;
    private $emailIT;
    private $mdpIT;
    private $add;
    private $modif;
    private $sup;
    private $click;
    private $id;

    public function __construct(array $argument = array())
    {

        if (!empty($argument)) {
            foreach ($argument as $key => $v) {
                $this->{$key} = $v;
            }
        }
    }

    public function __set($Type, $value)
    {
        $this->$Type = $value;
    }

    public function __get($email)
    {
        return $this->$email;
    }

    public function invoke($entityManager)
    {
        
        if (isset($_COOKIE["emailE"]) && isset($_COOKIE["mdpE"])) {
            $this->email = $_COOKIE["emailE"];
            $this->mdp = $_COOKIE["mdpE"];
            $resE = $entityManager->getRepository('Entity\Employees')->findOneBy([
                "employee_email" => $this->email,
                "employee_password" => $this->mdp,
                "employee_role" => "employee"
            ]);

            if ($resE != null) {
                // Mettre à jour les cookies
                setcookie("emailE", $resE->getEmployeeEmail(), time() + 7200);
                setcookie("mdpE", $resE->getEmployeePassword(), time() + 7200);

                // Stocker les informations de session
                $_SESSION["AccountEmployee"] = ["id" => $resE->getEmployeeId(), "role" => $resE->getEmployeeRole()];
                $_SESSION["StoreEmployee"] = $resE->getStoreId()->getStoreId();

                // Vérifier si l'action est valide pour un employé
                $validEmployeeActions = ["accueilE", "magasinE", "GestionE", "accountE", "update", "insert", "delete", "Deco", "mention"];
                if (isset($this->action) && in_array($this->action, $validEmployeeActions)) {
                    if ($this->action == "Deco") {
                        session_reset();
                        if (isset($_COOKIE["emailE"])) {
                            setcookie("emailE", "", 0);
                        }
                        if (isset($_COOKIE["mdpE"])) {
                            setcookie("mdpE", "", 0);
                        }
                        session_reset();
                        require_once("view/Client/accueilC.php");
                        return;
                    }
                    // Charger la page correspondant à l'action
                    require_once("view/Employee/{$this->action}.php");
                } else {
                    // Rediriger vers la page d'accueil employé par défaut
                    $_SESSION["action"] = "accueilE";
                    require_once("view/Employee/accueilE.php");
                }
                return;
            }
        }
        if (isset($_COOKIE["emailEC"]) && isset($_COOKIE["mdpEC"])) {
            $this->email = $_COOKIE["emailEC"];
            $this->mdp = $_COOKIE["mdpEC"];
            $resC = $entityManager->getRepository('Entity\Employees')->findOneBy([
                "employee_email" => $this->email,
                "employee_password" => $this->mdp,
                "employee_role" => "chief"
            ]);
            if ($resC != null) {
                // Mettre à jour les cookies
                setcookie("emailEC", $resC->getEmployeeEmail(), time() + 187200);
                setcookie("mdpEC", $resC->getEmployeePassword(), time() + 187200);

                // Stocker les informations de session
                $_SESSION["AccountEmployee"] = ["id" => $resC->getEmployeeId(), "role" => $resC->getEmployeeRole()];
                $_SESSION["StoreEmployee"] = $resC->getStoreId()->getStoreId();

                // Vérifier si l'action est valide pour un chef
                $validChefActions = ["accueilEC", "magasinEC", "GestionEC", "accountEC", "updateEC", "insertEC", "deleteEC", "Deco", "mention"];
                if (isset($this->action) && in_array($this->action, $validChefActions)) {
                    if ($this->action == "Deco") {
                        session_reset();
                        if (isset($_COOKIE["emailEC"])) {
                            setcookie("emailEC", "", 0);
                        }
                        if (isset($_COOKIE["mdpEC"])) {
                            setcookie("mdpEC", "", 0);
                        }
                        session_reset();
                        require_once("view/Client/accueilC.php");
                        return;
                    }
                    // Charger la page correspondant à l'action
                    require_once("view/Chef/{$this->action}.php");
                } else {
                    // Rediriger vers la page d'accueil chef par défaut
                    $_SESSION["action"] = "accueilEC";
                    require_once("view/Chef/accueilEC.php");
                }
                return;
            }
        }
        if (isset($_COOKIE["emailIT"]) && isset($_COOKIE["mdpIT"])) {
            $this->email = $_COOKIE["emailIT"];
            $this->mdp = $_COOKIE["mdpIT"];
            $resIT = $entityManager->getRepository('Entity\Employees')->findOneBy([
                "employee_email" => $this->email,
                "employee_password" => $this->mdp,
                "employee_role" => "it"
            ]);
            if ($resIT != null) {
                // Mettre à jour les cookies
                setcookie("emailIT", $resIT->getEmployeeEmail(), time() + 187200);
                setcookie("mdpIT", $resIT->getEmployeePassword(), time() + 187200);

                // Stocker les informations de session
                $_SESSION["AccountEmployee"] = ["id" => $resIT->getEmployeeId(), "role" => $resIT->getEmployeeRole()];
                $_SESSION["StoreEmployee"] = $resIT->getStoreId()->getStoreId();

                // Vérifier si l'action est valide pour un IT
                $validItActions = ["accueilIT", "magasinIT", "GestionIT", "accountIT", "updateIT", "insertIT", "deleteIT", "Deco", "mention"];
                if (isset($this->action) && in_array($this->action, $validItActions)) {
                    if ($this->action == "Deco") {
                        session_reset();
                        if (isset($_COOKIE["emailIT"])) {
                            setcookie("emailIT", "", 0);
                        }
                        if (isset($_COOKIE["mdpIT"])) {
                            setcookie("mdpIT", "", 0);
                        }
                        session_reset();
                        require_once("view/Client/accueilC.php");
                        return;
                    }
                    // Charger la page correspondant à l'action
                    require_once("view/IT/{$this->action}.php");
                } else {
                    // Rediriger vers la page d'accueil IT par défaut
                    $_SESSION["action"] = "accueilIT";
                    require_once("view/IT/accueilIT.php");
                }
                return;
            }
        }

        if (isset($this->action)) {
            if ($this->action == "form") {
                require_once("view/indexView.php");
            } else if ($this->action == "log") {
                if (isset($_POST["email"], $_POST["mdp"])) {
                    $this->email = trim($_POST["email"]);
                    $this->mdp = trim($_POST["mdp"]);
                    $resE = $entityManager->getRepository('Entity\Employees')->findOneBy(["employee_email" => $this->email, "employee_password" => $this->mdp, "employee_role" => "employee"]);                    //ConnexionEmployee($this->email,$this->mdp);                    
                    $resC = $entityManager->getRepository('Entity\Employees')->findOneBy(["employee_email" => $this->email, "employee_password" => $this->mdp, "employee_role" => "chief"]);
                    $resIT = $entityManager->getRepository('Entity\Employees')->findOneBy(["employee_email" => $this->email, "employee_password" => $this->mdp, "employee_role" => "it"]);

                    if ($resE != null) {
                        setcookie("emailE", $resE->getEmployeeEmail(), time() + 187200);
                        setcookie("mdpE", $resE->getEmployeePassword(), time() + 187200);
                        $_SESSION["action"] = "accueilE";
                        $_SESSION["AccountEmployee"] = ["id" => $resE->getEmployeeId(), "role" => $resE->getEmployeeRole()];
                        $_SESSION["StoreEmployee"] = $resE->getStoreId()->getStoreId();
                        require_once("view/Employee/accueilE.php");
                    } else if ($resC != null) {
                        setcookie("emailEC", $resC->getEmployeeEmail(), time() + 187200);
                        setcookie("mdpEC", $resC->getEmployeePassword(), time() + 187200);
                        $_SESSION["action"] = "accueilEC";
                        $_SESSION["AccountEmployee"] = ["id" => $resC->getEmployeeId(), "role" => $resC->getEmployeeRole()];

                        $_SESSION["StoreEmployee"] = $resC->getStoreId()->getStoreId();
                        require_once("view/Chef/accueilEC.php");
                    } else if ($resIT != null) {
                        setcookie("emailIT", $resIT->getEmployeeEmail(), time() + 187200);
                        setcookie("mdpIT", $resIT->getEmployeePassword(), time() + 187200);
                        $_SESSION["action"] = "accueilIT";
                        $_SESSION["AccountEmployee"] = ["id" => $resIT->getEmployeeId(), "role" => $resIT->getEmployeeRole()];

                        $_SESSION["StoreEmployee"] = $resIT->getStoreId()->getStoreId();
                        require_once("view/IT/accueilIT.php");
                    } else {
                        session_reset();
                        $_SESSION["error"] = "Erreur de connexion Identifiants incorrects";
                        require_once("view/indexView.php");
                    }
                } else {
                    session_reset();
                    $_SESSION["error"] = "Erreur de connexion";
                    require_once("view/indexView.php");
                }
            } else if ($this->action == "accueilC") {
                require_once("view/Client/accueilC.php");
            } else if ($this->action == "magasinC") {
                require_once("view/Client/magasin.php");
            } else if ($this->action == "mention") {
                require_once("view/mention.php");
            } else if ($this->action == "Deco") {
                session_reset();
                if (isset($_COOKIE["emailE"])) {
                    setcookie("emailE", "", 0);
                }
                if (isset($_COOKIE["mdpE"])) {
                    setcookie("mdpE", "", 0);
                }
                if (isset($_COOKIE["emailEC"])) {
                    setcookie("emailE", "", 0);
                }
                if (isset($_COOKIE["mdpEC"])) {
                    setcookie("mdpE", "", 0);
                }
                if (isset($_COOKIE["emailIT"])) {
                    setcookie("emailE", "", 0);
                }
                if (isset($_COOKIE["mdpIT"])) {
                    setcookie("mdpE", "", 0);
                }
                session_reset();

                require_once("view/Client/accueilC.php");
            } else {
                session_reset();

                require_once("view/Client/accueilC.php");
            }
        } else {
            require_once("view/Client/accueilC.php");
        }
    }
}
