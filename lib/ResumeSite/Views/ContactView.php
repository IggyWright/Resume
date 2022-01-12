<?php
namespace ResumeSite\Views;

class ContactView extends View{
    public function __construct() {
        $this->setTitle("Sean Wright");

        $this->addLink("index.php", "About");
        $this->addLink("resume.php", "Resume");
        $this->addLink("projects.php", "Projects");
        $this->addLink("contact.php", "Contact", true);
    }

    public function contactWidget() {
        $html = <<<HTML
            <div id="contactWidget">
                <div class="contactTitle">Phone:
                    <a class="contactContent" href="tel:12489826380">+1 (248) 982 - 6380</a>
                </div>
                <div class="contactTitle">Email:
                    <a class="contactContent" href="mailto:iggy.wright81@gmail.com">iggy.wright81@gmail.com</a>
                </div>
                <div class="contactTitle">Github:
                    <a class="contactContent" href="https://github.com/IggyWright">IggyWright</a>
                </div>
            </div>
HTML;

        return $html;
    }

}
