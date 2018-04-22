<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Entities\Pledge;
use Mail;

class SingupPledge
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $pledge;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Pledge $pledge)
    {
        $this->pledge = $pledge;
        if($pledge->status == 2){
            // $this->sendMailToPledge();
            $this->sendMailToOwner();
            $this->checkForDuplicate();
        }
    }

    public function sendMailToPledge(){
        $mail = Mail::raw($this->createMail(), function ($message) {
            $message->from('leiding@introalmere.nl', 'Stichting Introductie Almere');
            $message->sender('leiding@introalmere.nl', 'Stichting Introductie Almere');
            $message->to($this->pledge->email, $this->pledge->fullName);
            $message->replyTo('leiding@introalmere.nl', 'Stichting Introductie Almere');
            $message->subject('Inschrijving voor de Introductie Almere '.date("Y"));
            $message->priority(2);
        });

    }
    public function sendMailToOwner(){
        $mail = Mail::raw($this->createMail(true), function ($message) {
            $message->from('leiding@introalmere.nl', 'Stichting Introductie Almere');
            $message->sender('leiding@introalmere.nl', 'Stichting Introductie Almere');
            $message->to("leiding@introalmere.nl", "Stichting Introductie Almere");
            $message->replyTo('leiding@introalmere.nl', 'Stichting Introductie Almere');
            $message->subject('Inschrijving FEUT#'.$this->pledge->id);
            $message->priority(3);
        });
    }
    public function checkForDuplicate(){
        $current_pledge = $this->pledge;
        $pledge = Pledge::where("id",'!=',$this->pledge->id);

        $pledge->where(function($query) use ($current_pledge) {
            $query->where("email",'=',$current_pledge->email);
            $query->whereNotIn("status",[6,7,8]);
            $query->orWhere(function($query) use($current_pledge){
                $query->where("firstname",'=',$current_pledge->firstname);
                $query->where("middlename",'=',$current_pledge->middlename);
                $query->where("lastname",'=',$current_pledge->lastname);
            });
            $query->orWhere("mobile",'=',$current_pledge->mobile);
        });
        foreach($pledge->get() as $dup){
            $dup->could_dup = 1;
            $dup->dup_id = $current_pledge->id;
            $dup->save();
        }
    }

    public function createMail($owner = false){
            $message=array();
			$message[] = 'Beste '.$this->pledge->firstname.', ';
			$message[] = '';
			$message[] = 'Jij hebt je ingeschreven voor de start van jouw studententijd: de introductieweek van Almere. Om je helemaal op de hoogte te brengen, ontvang je daarom deze nieuwsbrief met informatie over:';
			$message[] = '1. Je inschrijving';
			$message[] = '2. Spullen om mee te nemen ';
			$message[] = '3. Betaling';
			$message[] = '4. Rabobank fietsen';
			$message[] = '5. Medi-Mere';
			$message[] = '6. Allergie/ziekten/etc. ';
			$message[] = '7. Contact ';
			$message[] = '';
			$message[] = 'Lees alles aandachtig door en pak je spullen in. Tot op de introductieweek!';
			$message[] = '';
			$message[] = '1. Jouw Inschrijving. ';
			$message[] = 'Dit is wat je hebt ingevuld: ';
			$message[] = 'Voorletters: '.$this->pledge->initials;
			$message[] = 'Naam: '.$this->pledge->fullName;
			$message[] = 'Geboortedatum: '.$this->pledge->dateofbirth;
			$message[] = 'Je bent een: '.$this->pledge->sexLabel;
			$message[] = 'Adres: '.$this->pledge->addrss;
			$message[] = 'Telefoon: '.$this->pledge->mobile;
			$message[] = 'Telefoon (nood): '.$this->pledge->emergency_phone;
			$message[] = 'Email: '.$this->pledge->email;
			$message[] = 'Shirtmaat: '.$this->pledge->shirt_size;
			$message[] = 'Dieet: '.($this->pledge->diet != "" && !is_null($this->pledge->diet)) ? $this->pledge->diet : "Geen";
			$message[] = 'Vegetariër: '.($this->pledge->vegetarian) ? "Ja" : "Nee";
			$message[] = 'Vooruit betalen: '.($this->pledge->pay_forward) ? "Ja" : "Nee";
			$message[] = 'Rabofiets: '.($this->pledge->rabo_bicycle) ? "Ja" : "Nee";
			$message[] = 'Studie: '.$this->pledge->education;
			$message[] = 'Voltijd/Deeltijd: '.$this->pledge->educationTypeLabel;
			$message[] = 'Opmerkingen: '.($this->pledge->description != "" && !is_null($this->pledge->description)) ? $this->pledge->description : "Geen";
			$message[] = 'Voorwaarden geaccepteerd: Ja ';
			$message[] = '';
			$message[] = 'Klopt er iets niet? Laat ons dat dan even weten! ';
			$message[] = '';
			$message[] = '2. Spullen om mee te nemen ';
			$message[] = 'De introductieweek is van maandagochtend 27 augustus 2018 tot en met vrijdagmiddag 31 augustus 2018. Maandag word je om 09:00 uur op station Almere Centrum verwacht. Daar zal je dan door ons opgevangen worden, we zijn te herkennen aan de gekleurde polo�s. Zorg ervoor dat je naast kleding en toiletspullen de volgende spullen bij je hebt: ';
			$message[] = '    - Lunchpakket voor de eerste dag';
			$message[] = '    - beker, bord, bestek';
			$message[] = '    - theedoek';
			$message[] = '    - handdoeken ';
			$message[] = '    - themaoutfit (het thema is "Safari") ';
			$message[] = '    - 1 rol aluminiumfolie';
			$message[] = '    - donkere sokken';
			$message[] = '    - kussen, slaapzak en luchtbed o.i.d.';
			$message[] = '    - regen- en zwemkleding ';
			$message[] = '    - zaklamp';
			$message[] = '    - fiets* (je hebt deze de hele week nodig)';		
			$message[] = '    - een cadeautje voor de organisatie';
			$message[] = '    - legitimatiebewijs, pinpas, etc.';
			$message[] = '    - geldige reisverzekering';
			$message[] = '    - eventuele medicatie';
			$message[] = '    - alles wat je verder nog nodig denkt te hebben om deze week door te komen ';
			$message[] = '';
			$message[] = 'Het is niet verstandig om waardevolle spullen mee te nemen. ';
			$message[] = '';
			$message[] = '3. Betaling';
			$message[] = 'De introductieweek kost slechts � 100,-. Hiervoor krijg je alle dagen heerlijk te eten (door een cateraar), een slaapplek en een heleboel activiteiten en feesten! ';
			$message[] = 'Je kunt op twee manieren betalen: ';
			$message[] = '- Betaal je voor 31 juli 2018, dan krijg je 25% korting en betaal je dus maar � 75,-. Maak het geld over op rekeningnummer NL85 RABO 0126 5494 78 t.n.v. Stichting Introductie Almere onder vermelding van: INTRO voornaam, achternaam en woonplaats.';
			$message[] = '- Je kunt ook betalen op de maandagochtend van de introductieweek; neem dan de �100,- contant mee.';
			$message[] = '';
			$message[] = '4. Rabobank fietsen ';
			$message[] = 'Als je NU een studentenrekening opent bij Rabobank Almere, krijg jij een gratis Rabofiets. Deze fiets staat dan de maandag van de introductieweek voor je klaar. Let wel op dat je zelf een slot meeneemt. Voor meer informatie over de Rabobank en de fietsenactie, kijk op';
			$message[] = 'https://www.rabobank.nl/particulieren/betalen/betaalpakketten/rabo-studentenpakket/?intcamp=pa-studenten-homepage&inttype=link-leesmeer&intsource=particulieren.studenten';
			$message[] = '';
			$message[] = '5. Medi-Mere';
			$message[] = 'Schrijf je nu in voor een ��n van onze studentenhuisartsen. Met deze studentenhuisartsen kan jij een persoonlijke band opbouwen en hierdoor heb jij al snel een vertrouwenspersoon in Almere. Deze studentenhuisartsen zijn op de hoogte van de ins en outs van het studentenleven, kijk op www.studentenhuisartsalmere.nl voor meer informatie. ';
			$message[] = '';
			$message[] = '6. Allergie/ziekte/etc.';
			$message[] = 'Indien je een allergie hebt, medicijnen gebruikt of een speciaal dieet volgt en dit nog niet aan ons door hebt gegeven, dan is het handig om dit alsnog te doen door een mail te sturen naar leiding@introalmere.nl. Wij zorgen er dan voor dat de catering hiervan op de hoogte is en hier rekening mee houdt. Als je dit al bij je inschrijving hebt gedaan, dan zijn we al op de hoogte! ';
			$message[] = '';
			$message[] = '7. Contact';
			$message[] = 'Heb je nog vragen, dan mag je altijd een mailtje sturen naar leiding@introalmere.nl.';
			$message[] = 'Heb je een vertrouwelijke vraag? Dan kun je bellen met onze vertrouwenspersoon Anne-Sophie 06 14 21 12 42.';
			$message[] = 'Wil je op de hoogte blijven van de vorderingen met betrekking tot de introductieweek, volg ons dan op Twitter: @introalmere, op de FB: Stichting Introductie Almere en ook op Instagram: @introalmere. Bekijk ook onze vernieuwde site: www.introductiealmere.nl';
			$message[] = ' ';
			$message[] = 'Wij hopen je voldoende te hebben geïnformeerd en zien je graag op de introductieweek! ';
			$message[] = '';
			$message[] = 'Groetjes namens de introleiding,';
			$message[] = '';
			$message[] = 'Yari Leferink, Anita Bakker, Max van der Meer en Anne-Sophie Lammers.';
			$message[] = '';
			$message[] = '';
            $message[] = 'Onze voorwaarden kun je hier lezen: http://www.introductie-almere.nl/bellen/bestanden/Introductie%20Almere%20Algemene%20Voorwaarden%202017.pdf';
            
            if($owner){
                implode("\n", $message);
                $message = str_repeat("=", 50)."\r"."KOPIE INTRODUCTIELEIDING VOOR FEUT#".$this->pledge->id."\r".str_repeat("=", 50)."\r".$message;
            }
            return implode("\n", $message);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
