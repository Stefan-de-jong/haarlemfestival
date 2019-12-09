<?php
    class Jazz extends Controller{
        public function __construct(){
            $this->JazzRepo = $this->repo('JazzRepository');
            //$this->JazzModel = $this->model('Jazz');   
        }

        public function Jazz(){
            $data = [
                'title' => 'Jazz main page'
            ];

            $this->view('pages/jazz/index', $data);
        }

        public function jazztickets(){
            $data = [
                'title' => 'Jazz tickets'
            ];

            $this->view('pages/jazz/day', $data);
        }

        public function jazzticketorder(){
            $data = [
                'title' => 'Jazz ticket order'
            ];

            $this->view('pages/jazz/popup', $data);
        }

        public function loadTickets()
        {
            $day = 2;
            if(isset($_POST["thursday"])) {
                $day = "2018-07-26";
            }
            if(isset($_POST["friday"])) {
                $day =  "2018-07-27";
            }
            if(isset($_POST["saturday"])) {
                $day = "2018-07-28";
            } 
            if(isset($_POST["sunday"])) {
                $day = "2018-07-29";
            }

            $array = explode("-", $day); 
            echo "
            <h1 class='title'>Shows on" . end($array) . "/" . prev($array) . "</h1>
            <table style='width:100%' class='ticket_table'>
            "; 
 
            include APPROOT . '/repos/JazzRepository.php';
            $events = $JazzRepo->GetEvents();
            foreach ($events as $event)
            {
                if ($event->date == $day) //artist & location moeten nog van nummer naar text maar he het is een begin
                {
                    echo "<tr> <td>" . $event->date . "</td> 
                    <td>" . $event->artist . "</td> <td>" . $event->location . "</td> <td>" . $event->begin_time . " until " . $event->end_time . "</td> <td> " . $event->price . " </td> <td> <input type='submit' value='Buy tickets' class='ChooseTicket'/> </td> </tr>";
                }
            echo "</table>";

            }
        }
    }
?>