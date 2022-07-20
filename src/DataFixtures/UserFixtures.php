<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = $manager->getRepository(Role::class)->findOneBy(['name' => 'user']);
        $admin = $manager->getRepository(Role::class)->findOneBy(['name' => 'admin']);

        $manager->persist(User::create("admin@mail.de", "Ilsegard Bräu", "51645", "Gummersbach", "02261/16005942", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $admin, null, true));
        $manager->persist(User::create("admin2@mail.de", "Ilsegard Bräu", "51645", "Gummersbach", "02261/16005942", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $admin, null, true));
        $manager->persist(User::create("admin3@mail.de", "Ilsegard Bräu", "51645", "Gummersbach", "02261/16005942", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $admin, null, true));
        $manager->persist(User::create("ilsegard-braeu@open-mail.none", "Ilsegard Bräu", "51645", "Gummersbach", "02261/16005942", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ddambacher@retromail.none", "Diemut Dambacher", "67229", "Gerolsheim", "06238/84397479", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("diemut.johne@goggle-mail.none", "Diemut Johne", "38226", "Salzgitter", "05341/53201545", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("altrudweide@net-mail.none", "Altrud Weide", "44803", "Bochum", "0234/90908810", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("heiderich_fehrmann@quickmail.none", "Heiderich Fehrmann", "72810", "Gomaringen", "07072/19390926", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("rosalinde_70@xyz.none", "Rosalinde Reusch", "54619", "Eschfeld", "06550/25678703", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("thoralf.steinmann@quickmail.none", "Thoralf Steinmann", "57072", "Siegen", "0271/80519569", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("w-behling@web.none", "Warnfried Behling", "39638", "Potzehne", "03907/37216404", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ditmar-1903@anymail.none", "Ditmar Fick", "97762", "Hammelburg", "09732/82391100", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("a-heller@net-mail.none", "Annaliese Heller", "82211", "Herrsching am Ammersee", "08152/91829397", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("sibyl-vick@hoster.none", "Sibyl Vick", "56865", "Moritzheim", "06542/95392680", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("mhensel@web.none", "Matti Hensel", "79771", "Klettgau", "07742/76099877", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("i.hoehmann@inter-mail.none", "Irmintraud Höhmann", "78234", "Engen", "07733/19998309", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("u.70@mymail.none", "Ute Völkel", "67744", "Kirrweiler", "06382/47289289", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("liane.agrar@open-mail.none", "Liane Agrar", "93155", "Hemau", "09491/50572200", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("e_78@domain.none", "Edmund Rißmann", "55624", "Bollenbach", "06544/71665119", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("sigishelm-23@live-mail.none", "Sigishelm Kasimir", "91452", "Wilhermsdorf", "09102/38360118", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("christophorusklingel@justmail.none", "Christophorus Klingel", "75242", "Neuhausen", "07234/12106867", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("jacob-dehne@anymail.none", "Jacob Dehne", "25524", "Breitenburg", "04828/31038783", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("h74@net-mail.none", "Heinzkarl Umbach", "58099", "Hagen", "02331/20206073", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("volkbert_54@web.none", "Volkbert Deeken", "96196", "Wattendorf", "09504/72263277", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("gittiknueppel@validmail.none", "Gitti Knüppel", "56253", "Treis-Karden", "02672/46921094", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("a_grawe@email.none", "Auguste Grawe", "56244", "Krümmel", "02626/54448722", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("bodmar_1973@email.none", "Bodmar Breunig", "33803", "Steinhagen", "05204/37924231", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("debora-hildebrandt@private.none", "Debora Hildebrandt", "82041", "Oberhaching", "089/91640559", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ingetraut_reinecke@private.none", "Ingetraut Reinecke", "53757", "Sankt Augustin", "02241/83277993", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("flennartz@live-mail.none", "Folker Lennartz", "23845", "Bahrenhof", "04550/62924233", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("steph.berk@validmail.none", "Steph Berk", "19288", "Warlow", "03874/36963397", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("resi.dinse@justmail.none", "Resi Dinse", "75015", "Bretten", "07252/10538853", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("oda-jurk@xyz.none", "Oda Jurk", "54298", "Orenhofen", "06562/44990007", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("j_2010@kitty.none", "Jennifer Jetter", "72172", "Sulz am Neckar", "07454/95318107", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("annelore2016@quickmail.none", "Annelore Staudt", "71272", "Renningen", "07159/2039743", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("swick@open-mail.none", "Sophia Wick", "72415", "Grosselfingen", "07476/77704927", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("caecilia.1949@retromail.none", "Cäcilia Brooks", "48624", "Schöppingen", "02555/90570948", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("d_mumme@web.none", "Dietlind Mumme", "55234", "Monzernheim", "06244/58216333", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("w-cross@kitty.none", "Wittmar Cross", "92281", "Königstein", "09665/54807241", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("guntram_sadowski@goggle-mail.none", "Guntram Sadowski", "61200", "Wölfersheim", "06036/91388277", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("helmrich_renz@net-mail.none", "Helmrich Renz", "24217", "Höhndorf", "04344/76564396", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ingathissen@validmail.none", "Inga Thissen", "48480", "Spelle", "05977/95729899", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("i.geiger@quickmail.none", "Ireneus Geiger", "23896", "Nusse", "04543/21149015", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("friedhold_helmert@web.none", "Friedhold Helmert", "39638", "Algenstedt", "03907/17555546", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("a_kienle@anymail.none", "Anett Kienle", "56332", "Brodenbach", "02607/60948604", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("roberto_1938@goggle-mail.none", "Roberto Hinz", "21785", "Belum", "04752/23515164", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("wenzelliebing@quickmail.none", "Wenzel Liebing", "31079", "Sibbesse", "05065/71462918", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("folker-goeb@spam-mail.none", "Folker Göb", "21493", "Grove", "04151/25586614", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("elisa_schepers@open-mail.none", "Elisa Schepers", "25557", "Seefeld", "04872/86682993", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("melisande_eden@spam-mail.none", "Melisande Eden", "55776", "Frauenberg", "06787/22306707", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("e.53@inter-mail.none", "Engelmar Root", "74206", "Bad Wimpfen", "07063/94304995", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("linda-81@inter-mail.none", "Linda Ketelsen", "83457", "Bayerisch Gmain", "08651/89335623", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("dariusseyfarth@private.none", "Darius Seyfarth", "87496", "Untrasried", "08372/25203718", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("e-10@open-mail.none", "Erdheide Strebel", "25551", "Peissen", "04821/92122175", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("agathe.diers@anymail.none", "Agathe Diers", "57520", "Kausen", "02747/35754296", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("senta_schoenwaelder@net-mail.none", "Senta Schönwälder", "27404", "Ostereistedt", "04284/76659326", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("w_suendermann@validmail.none", "Wilfried Sündermann", "40223", "Düsseldorf", "0211/33595792", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("adelfried.klaas@retromail.none", "Adelfried Klaas", "54316", "Lampaden", "06589/19527141", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ernstine1987@web.none", "Ernstine Bachl", "54597", "Matzerath", "06551/62379669", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("benno_remy@live-mail.none", "Benno Remy", "56814", "Beilstein", "02673/21501421", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("annehildkampmann@ultramail.none", "Annehild Kampmann", "94146", "Hinterschmiding", "08551/89954488", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("wiltrude_kamps@hoster.none", "Wiltrude Kamps", "54552", "Nerdlen", "06592/18310474", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("juergen_2014@inter-mail.none", "Jürgen Klapp", "54649", "Lauperath", "06550/96148566", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("h.moennich@ultramail.none", "Harro Mönnich", "38110", "Braunschweig", "0531/71109609", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("s_dorner@goggle-mail.none", "Sigisbert Dorner", "56424", "Ebernhahn", "02602/96318693", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("amreilichtenberg@email.none", "Amrei Lichtenberg", "66132", "Saarbrücken", "0681/2675185", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("liobaschlichting@email.none", "Lioba Schlichting", "72631", "Aichtal", "07127/66857144", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("elizabeth-vogelmann@retromail.none", "Elizabeth Vogelmann", "67251", "Freinsheim", "06353/51244161", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("d-reckert@funmail.none", "Dorina Reckert", "70771", "Leinfelden-Echterdingen", "0711/64006727", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("fraenzi.1930@trashmail.none", "Fränzi Martina", "57584", "Wallmenroth", "02741/29059297", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("hanskarl_fink@spam-mail.none", "Hanskarl Fink", "56132", "Dausenau", "02603/19215312", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("maximillianschnapp@mymail.none", "Maximillian Schnapp", "54492", "Zeltingen-Rachtig", "06532/94387675", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("karsten.soto@quickmail.none", "Karsten Soto", "23628", "Klempau", "04544/37022342", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("sieghelmjaeger@goggle-mail.none", "Sieghelm Jaeger", "57629", "Mörsbach", "02662/77869598", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("m_markovic@domain.none", "Maurus Markovic", "33449", "Langenberg", "05248/94956233", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("m_stoeckel@open-mail.none", "Markward Stöckel", "33824", "Werther", "05203/42543791", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("carolin.1981@trashmail.none", "Carolin Ecke", "54689", "Dahnen", "06550/79564692", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("h2007@live-mail.none", "Hanfried Horstmann", "67098", "Bad Dürkheim an der Weinstraße", "06322/2752880", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("n_drews@company.none", "Nikolas Drews", "83115", "Neubeuern", "08035/9863853", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("e.14@inter-mail.none", "Erltrud Bark", "86477", "Adelsried", "08294/46021478", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("augustinus.doering@ultramail.none", "Augustinus Doering", "52249", "Eschweiler", "02403/3479793", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("d-62@private.none", "Dustin Bark", "54673", "Plascheid", "06564/99271309", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ingerosesinner@funmail.none", "Ingerose Sinner", "49492", "Westerkappeln", "05404/26026335", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("robertillner@hoster.none", "Robert Illner", "54675", "Roth an der Our", "06564/86567836", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("j_buehrmann@quickmail.none", "Jonathan Bührmann", "09306", "Thalheim", "03721/44994187", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("a-67@domain.none", "Arnulf Dieck", "54636", "Dahlem", "06561/58425034", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("maik.hirth@quickmail.none", "Maik Hirth", "84546", "Egglkofen", "08639/55511676", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("t_1981@ultramail.none", "Tom Felder", "37632", "Eschershausen", "05534/2020935", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("g_rodriquez@retromail.none", "Gudrun Rodriquez", "25554", "Wilster", "04823/36411205", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("maxsahin@bestmail.none", "Max Sahin", "42281", "Wuppertal", "0202/97836852", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("edeltraut-04@xyz.none", "Edeltraut Kauer", "66887", "Neunkirchen am Potzberg", "06381/72157029", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("b_pohle@retromail.none", "Burglinde Pohle", "23936", "Bernstorf", "03881/42931679", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("constantin.79@email.none", "Constantin Hugo", "67482", "Altdorf", "06327/70975997", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("f-blecher@anymail.none", "Friderike Blecher", "25924", "Klanxbüll", "04668/37451645", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("alexandra-06@bestmail.none", "Alexandra Steier", "26936", "Stadland", "04732/2212743", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("lambert_borges@funmail.none", "Lambert Borges", "26215", "Wiefelstede", "04402/89047872", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("c.scharnagl@company.none", "Cäcilie Scharnagl", "35582", "Wetzlar", "06441/85694666", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("sibilla-peil@spam-mail.none", "Sibilla Peil", "84051", "Essenbach", "08703/76165509", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("karlernst34@web.none", "Karlernst Dillmann", "58509", "Lüdenscheid", "02351/52047268", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("ernstineerdmann@ultramail.none", "Ernstine Erdmann", "29465", "Schnega", "05842/19242634", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("adolphdudek@domain.none", "Adolph Dudek", "31655", "Stadthagen", "05721/82949631", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("chautmann@ultramail.none", "Cäcilia Hautmann", "67294", "Ilbesheim", "06352/79754154", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));
        $manager->persist(User::create("aileen_lahn@email.none", "Aileen Lahn", "91183", "Abenberg", "09873/63551576", "$2y$13$0lwJ.IzvO9d0TjWyujQZUe0KEwc2Qm4GvVcBd.EXKMHUdU/XI.Ac.", $user, null, true));


        $manager->flush();
    }
}
