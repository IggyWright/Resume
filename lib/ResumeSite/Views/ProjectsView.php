<?php
namespace ResumeSite\Views;

class ProjectsView extends View{
    public function __construct() {
        $this->setTitle("Sean Wright");

        $this->addLink("index.php", "About");
        $this->addLink("resume.php", "Resume");
        $this->addLink("projects.php", "Projects", true);
        $this->addLink("contact.php", "Contact");
    }

    public function projectsWidget() {
        $html = <<<HTML
            <div id="projectsWidget">
                <div id="projectsIntro">Please take a look at all of my personal projects!</div>
HTML;

        $html .= $this->buildProjectWidget(
            "BoolAlpha",
            "https://boolalpha.com",
            "img/projects/BoolAlpha",
            ["Consulting", "PHP", "Apache", "React", "Javascript", "Web3", "EVM"],
            [
                "This is my personal consulting website I use to help people build their websites."
            ]
        );

        $html .= $this->buildProjectWidget(
            "BillyBlocks",
            "https://billynft.com",
            "img/projects/BillyBlocks",
            ["Solidity", "NodeJS", "Apache", "React", "Javascript", "Web3", "EVM"],
            [
                "Built as a proof of concept of the abilities of the recent crypto technology craze.",
                "Utilizes a smart contract written with Solidity to execute the desired tokenomics",
                "Currently, waves of pixels are released which users can mint to their Metamask wallet and create a square pixel image.",
                "Released on a Polygon network",
                "Color info is stored in metadata hosted on IPFS for true decentralization"
            ]
        );

        $html .= $this->buildProjectWidget(
            "CoderBoards",
            "https://coderboards.com",
            "img/projects/CoderBoards",
            ["EasyEDA", "Linux", "Apache", "MySQL", "PHP", "Javascript"],
            [
                "Created my own PCB design to accommodate ESP32 microcontroller board of any size, connected to a 10x10 led grid.",
                "Built a custom website to make it very easy to create animations that load to the board and are controlled by custom user built menus while helping people learn to code in the process."
            ]
        );

        $html .= $this->buildProjectWidget(
            "ModMound: Self Watering Planter",
            "https://modmound.com",
            "img/projects/ModMound",
            ["SketchUp", "Anycubic 3D Printing", "Linux", "Apache", "MySQL", "PHP", "Javascript"],
            [
                "CAD designed and 3D printed a planter that can help water your plants the perfect amount using water's capillary action",
                "All designs are available for download for free on the website."
            ]
        );

        $html .= $this->buildProjectWidget(
            "PandemicPlate",
            "https://pandemicplate.com",
            "img/projects/PandemicPlate",
            ["SketchUp", "Anycubic 3D Printing", "Linux", "Apache", "MySQL", "PHP", "Javascript", "Smooth-On"],
            [
                "My attempt to make an open source weight plate when home gyms became the craze during the pandemic.",
                "Non-crack cement interior, rebar reinforced, urethane rubber coating, and steel center ring all at Olympic Plate dimensions.",
                "All designs are available for download for free on the website."
            ]
        );

        $html .= $this->buildProjectWidget(
            "Wells Fargo Mindsumo Competition - Machine Learning App",
            "",
            "img/projects/WFML",
            ["Python", "Sketch App"],
            [
                "<a href=\"Files/WF_ML.py\">Code can be viewed here.</a>",
                "Finished 6th out of 38 competitors for a challenge offered by Wells Fargo through Mindsumo to all campuses.",
                "The idea was that you are given a list of about 7,000 customers and each customer had indications as to how much carbon they consume and how they consume it (automotive transportation habits, AC/heat usage, water consumption habits, etc).",
                "Along with the consumption, a ranking of the quality of life that each utility provided to the customer was given. The goal of the challenge was to use \"Machine Learning\" in some way to reduce the carbon usage of the customers while not lowering their quality of life.",
                "I chose to clean and separate the data by finding the relation of carbon to life quality (carbon consumption : quality of life).",
                "I then used a K-means unsupervised ML algortihm to group the data into \"good\" or \"bad\" customers compared to the other customers consumption patterns.",
                "My idea for the app was that consumers could connect their utilities and then using a KNN ML algorithm attempt to predict whether a customer was being \"good\" or \"bad\" based on what percentile they ranked in terms of environmental effects",
                "Further information can be found <a href=\"Files/Deliverable1.pdf\">here.</a>"
            ]
        );

        $html .= $this->buildProjectWidget(
            "Colorchasm - Mobile Game",
            "",
            "img/projects/Colorchasm",
            ["Unity", "C#", "Google Play Store", "Google Admob"],
            [
                "First game created, player is rolling along and endless track trying to collect gems and keys in order to make it through the next gate.",
                "Was monetized through banner and pop up ads and published on the Google Play store."
            ]
        );

        $html .= $this->buildProjectWidget(
            "Flatiron - Mobile Game",
            "",
            "img/projects/Flatiron",
            ["Unity", "C#"],
            [
                "Player is controled through \"keyring\" like movements.",
                "Tail trail renderer that detects a collision. The idea behind this game is that there are 4 waves (small, medium, large, misc.) of enemies and each wave will get progressively more difficult."
            ]
        );

        $html .= $this->buildProjectWidget(
            "W&W Drone Tours",
            "",
            "img/projects/Drone",
            ["DJI Software", "Lightworks", "iMovie"],
            [
                "Helped begin a company that edited drone footage for real estate purposes.",
                "Traveled throughout Michigan, Wisconsin, and Indiana to path flight patterns, direct footage, and deliver edited videos to customers."
            ]
        );

        $html .= <<<HTML
            </div>
HTML;

        return $html;
    }

    private function buildProjectWidget($title, $link, $mediaDir, $techStack, $bulletList) {
        $html = '<div class="projectContainer">';

        $html .= '<div class="projectTitle">' . $title;
        if($link != "") {
            $html .= ' - <a href="' . $link . '">' . $link . '</a>';
        }
        $html .= '</div>';

        $html .= '<div class="mediaContainer">';
        $files = [];
        if ($handle = opendir($mediaDir)) {
            while (false !== ($file = readdir($handle))) {
                if ('.' === $file) continue;
                if ('..' === $file) continue;
                array_push($files, $file);

            }
            closedir($handle);
        }
        sort($files);
        for ($i = 0; $i < count($files); $i++) {
            $file = $files[$i];
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if(in_array($extension, ['jpg', 'png'])) {
            // if (($extension == 'jpg') || ($extension == 'png')) {
                $html .= '<img class="projectMedia" src="' . $mediaDir . '/' . $file . '"></img>';
            } else if(in_array($extension, ['mp4', 'mov'])) {
                $html .= '<video controls muted loop class="projectMedia" autoplay loading="lazy"><source src="' . $mediaDir . '/' . $file . '" type="video/mp4"></video>';
            }
        }
        $html .= '</div>';

        $html .= '<div class="techStackContainer">';
        for($i = 0; $i < count($techStack); $i++) {
            $html .= $this->getTechClass($techStack[$i]);
        }
        $html .= '</div>';

        $html .= '<div class="descriptionContainer">';
        for($i = 0; $i < count($bulletList); $i++) {
            $html .= '<div class="bulletContainer"><div class="bulletPoint"></div><div class="descriptionText">' . $bulletList[$i] . '</div></div>';
        }
        $html .= '</div>';

        $html .= '</div>';
        return $html;
    }

    private function getTechClass($tech) {
        switch ($tech) {
            case 'React' :
                return '<div class="techStack react"><img class="techLogo" src="img/projects/logos/reactLogo.png"/>' . $tech . '</div>';
                break;
            case 'Apache' :
                return '<div class="techStack apache"><img class="techLogo" src="img/projects/logos/apacheLogo.png"/>' . $tech . '</div>';
                break;
            case 'Javascript' :
                return '<div class="techStack javascript"><img class="techLogo" src="img/projects/logos/javascriptLogo.png"/>' . $tech . '</div>';
                break;
            case 'NodeJS' :
                return '<div class="techStack nodejs"><img class="techLogo" src="img/projects/logos/nodejsLogo.png"/>' . $tech . '</div>';
                break;
            case 'Solidity' :
                return '<div class="techStack solidity"><img class="techLogo" src="img/projects/logos/solidityLogo.png"/>' . $tech . '</div>';
                break;
            case 'DJI Software' :
                return '<div class="techStack dji"><img class="techLogo" src="img/projects/logos/djiLogo.png"/>' . $tech . '</div>';
                break;
            case 'Lightworks' :
                return '<div class="techStack lightworks"><img class="techLogo" src="img/projects/logos/lightworksLogo.png"/>' . $tech . '</div>';
                break;
            case 'iMovie' :
                return '<div class="techStack imovie"><img class="techLogo" src="img/projects/logos/imovieLogo.png"/>' . $tech . '</div>';
                break;
            case 'Unity' :
                return '<div class="techStack unity"><img class="techLogo" src="img/projects/logos/unityLogo.png"/>' . $tech . '</div>';
                break;
            case 'C#' :
                return '<div class="techStack csharp"><img class="techLogo" src="img/projects/logos/csharpLogo.png"/>' . $tech . '</div>';
                break;
            case 'Google Play Store' :
                return '<div class="techStack googlePlay"><img class="techLogo" src="img/projects/logos/googlePlayLogo.png"/>' . $tech . '</div>';
                break;
            case 'Google Admob' :
                return '<div class="techStack googleAdmob"><img class="techLogo" src="img/projects/logos/googleAdmobLogo.png"/>' . $tech . '</div>';
                break;
            case 'Sketch App' :
                return '<div class="techStack sketchApp"><img class="techLogo" src="img/projects/logos/sketchAppLogo.png"/>' . $tech . '</div>';
                break;
            case 'Python' :
                return '<div class="techStack python"><img class="techLogo" src="img/projects/logos/pythonLogo.png"/>' . $tech . '</div>';
                break;
            case 'PHP' :
                return '<div class="techStack php"><img class="techLogo" src="img/projects/logos/phpLogo.png"/>' . $tech . '</div>';
                break;
            case 'MySQL' :
                return '<div class="techStack mysql"><img class="techLogo" src="img/projects/logos/mysqlLogo.png"/>' . $tech . '</div>';
                break;
            case 'Linux' :
                return '<div class="techStack linux"><img class="techLogo" src="img/projects/logos/linuxLogo.png"/>' . $tech . '</div>';
                break;
            case 'EasyEDA' :
                return '<div class="techStack easyeda"><img class="techLogo" src="img/projects/logos/easyedaLogo.png"/>' . $tech . '</div>';
                break;
            case 'Anycubic 3D Printing' :
                return '<div class="techStack anycubic"><img class="techLogo" src="img/projects/logos/anycubicLogo.png"/>' . $tech . '</div>';
                break;
            case 'SketchUp' :
                return '<div class="techStack sketchup"><img class="techLogo" src="img/projects/logos/sketchupLogo.png"/>' . $tech . '</div>';
                break;
            default:
                return '<div class="techStack"><img class="techLogo" src="img/projects/logos/computerLogo.png"/>' . $tech . '</div>';
                break;
        }

    }
}
