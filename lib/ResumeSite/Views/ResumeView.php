<?php
namespace ResumeSite\Views;

class ResumeView extends View{
    public function __construct() {
        $this->setTitle("Sean Wright");

        $this->addLink("index.php", "About");
        $this->addLink("resume.php", "Resume", true);
        $this->addLink("projects.php", "Projects");
        $this->addLink("contact.php", "Contact");
    }

    public function resumeWidget() {
        $html = <<<HTML
            <div id="resumeWidget">
                <a id="downloadResumeButton" href="Files/resume.pdf" download="Files/resume.pdf">Download Resume</a>
                <div id="resumeImgContainer">
                    <img id="resumeImg" src="Files/resume.png" />
                    <a id="resumeImgClick" href="Files/resume.pdf"></a>
                <div>
            </div>
HTML;

        return $html;
    }

}
