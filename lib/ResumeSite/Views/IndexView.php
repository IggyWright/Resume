<?php
namespace ResumeSite\Views;

class IndexView extends View{
    public function __construct() {
        $this->setTitle("Sean Wright");

        $this->addLink("index.php", "About", true);
        $this->addLink("resume.php", "Resume");
        $this->addLink("projects.php", "Projects");
        $this->addLink("contact.php", "Contact");
    }

    public function indexWidget() {
        $html = <<<HTML
            <div id="indexWidget">
                <img id="personalImage" src="img/images/personal.png" />
                <div id="infoContainer">
                    <div id="infoParagraph">
                        Full stack developer with a specific interest in Web3! Computer science graduate from Michigan State University.
                    </div>
                    <a id="projectsButton" href="projects.php">View My Projects</a>
                </div>
            </div>
HTML;

        return $html;
    }
}
