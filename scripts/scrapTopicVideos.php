<?php
/**
 * Created by PhpStorm.
 * User: spider-ninja
 * Date: 3/2/17
 * Time: 3:37 PM
 */


function postCall($url,$postArr){

    $content = json_encode($postArr);
    echo $content."\n";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RESOLVE, ["api.examhans.com:80:52.66.85.75"]);

   // curl_setopt($curl, CURLOPT_VERBOSE, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

    $json_response = curl_exec($curl);

    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    if ( $status != 200 ) {
        die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
    }


    curl_close($curl);
    echo $json_response;

    return json_decode($json_response, true);

}

function postQuestion($video,$topicId){


    return postCall('http://api.examhans.com/topics/'.$topicId.'/videos',$video);

}

$topicsStr = "[{\"id\": 214,\"name\": \"Alligation or Mixture\"}, {\"id\": 2,\"name\": \"Alphabet Series\"}, {\"id\": 238,\"name\": \"Analysing Arguments\"}, {\"id\": 246,\"name\": \"Analytical Reasoning\"}, {\"id\": 6,\"name\": \"Arithmetical Reasoning\"}, {\"id\": 254,\"name\": \"Artificial Intelligence\"}, {\"id\": 239,\"name\": \"Artificial Language\"}, {\"id\": 255,\"name\": \"Automation System\"}, {\"id\": 64,\"name\": \"Awards and Honors\"}, {\"id\": 8,\"name\": \"Blood Relations\"}, {\"id\": 63,\"name\": \"Books and Authors\"}, {\"id\": 60,\"name\": \"Budget and Five Year Plans\"}, {\"id\": 215,\"name\": \"Cause and Effect\"}, {\"id\": 222,\"name\": \"Chain Rule\"}, {\"id\": 228,\"name\": \"Change  of Speech\"}, {\"id\": 229,\"name\": \"Closet Set\"}, {\"id\": 191,\"name\": \"Complementary Angles\"}, {\"id\": 230,\"name\": \"Completing Statement\"}, {\"id\": 167,\"name\": \"Computation of Whole Number\"}, {\"id\": 256,\"name\": \"Computer Fundamental\"}, {\"id\": 176,\"name\": \"Congruence and similarity of t\"}, {\"id\": 240,\"name\": \"Courses of Action\"}, {\"id\": 13,\"name\": \"Cubes and Dice\"}, {\"id\": 58,\"name\": \"Current Affairs\"}, {\"id\": 45,\"name\": \"Data Interpretation\"}, {\"id\": 216,\"name\": \"Data Sufficiency\"}, {\"id\": 202,\"name\": \"Database\"}, {\"id\": 34,\"name\": \"Decimal Fractions\"}, {\"id\": 10,\"name\": \"Decision Making\"}, {\"id\": 189,\"name\": \"Degree and Radian Measures\"}, {\"id\": 257,\"name\": \"Digital Electronics\"}, {\"id\": 170,\"name\": \"Discount\"}, {\"id\": 258,\"name\": \"Disk Operating System - DOS\"}, {\"id\": 259,\"name\": \"Electronics Principles\"}, {\"id\": 15,\"name\": \"Embedded Figures\"}, {\"id\": 49,\"name\": \"Error Correction\"}, {\"id\": 241,\"name\": \"Essential Part\"}, {\"id\": 248,\"name\": \"Famous Places\"}, {\"id\": 52,\"name\": \"Fill in the Blanks\"}, {\"id\": 195,\"name\": \"Frequency polygon\"}, {\"id\": 250,\"name\": \"Geography\"}, {\"id\": 174,\"name\": \"Geometry\"}, {\"id\": 173,\"name\": \"Graphs of Linear Equations\"}, {\"id\": 14,\"name\": \"Grouping Identical Figures\"}, {\"id\": 200,\"name\": \"Hardware\"}, {\"id\": 32,\"name\": \"HCF, LCM\"}, {\"id\": 192,\"name\": \"Heights and Distances\"}, {\"id\": 184,\"name\": \"Hemispheres\"}, {\"id\": 194,\"name\": \"Histogram\"}, {\"id\": 199,\"name\": \"History Of Computers\"}, {\"id\": 231,\"name\": \"Idioms and Phrases\"}, {\"id\": 67,\"name\": \"Important Days & Year\"}, {\"id\": 249,\"name\": \"Indian Culture\"}, {\"id\": 251,\"name\": \"Indian History\"}, {\"id\": 252,\"name\": \"Indian Politics\"}, {\"id\": 68,\"name\": \"International and National Org\"}, {\"id\": 205,\"name\": \"Internet\"}, {\"id\": 260,\"name\": \"Language Processors\"}, {\"id\": 261,\"name\": \"Linux\"}, {\"id\": 268,\"name\": \"Logarithm\"}, {\"id\": 208,\"name\": \"Logic Gates\"}, {\"id\": 210,\"name\": \"Logical Arrangement of Words\"}, {\"id\": 242,\"name\": \"Logical Deduction\"}, {\"id\": 59,\"name\": \"Major Financial/Economic\"}, {\"id\": 262,\"name\": \"Management Information System\"}, {\"id\": 43,\"name\": \"Menstruation (2D and 3D)\"}, {\"id\": 12,\"name\": \"Mirror Images\"}, {\"id\": 172,\"name\": \"Mixture and Allegation\"}, {\"id\": 209,\"name\": \"MS Office\"}, {\"id\": 207,\"name\": \"MS Windows\"}, {\"id\": 204,\"name\": \"Networking\"}, {\"id\": 11,\"name\": \"Non Verbal Series\"}, {\"id\": 5,\"name\": \"Number Ranking\"}, {\"id\": 1,\"name\": \"Number Series\"}, {\"id\": 31,\"name\": \"Number System\"}, {\"id\": 198,\"name\": \"Number System\"}, {\"id\": 263,\"name\": \"Object Oriented Programming\"}, {\"id\": 264,\"name\": \"Operating System\"}, {\"id\": 233,\"name\": \"Ordering of Words\"}, {\"id\": 234,\"name\": \"Paragraph Formation\"}, {\"id\": 171,\"name\": \"Partnership Business\"}, {\"id\": 247,\"name\": \"Pattern Completion\"}, {\"id\": 37,\"name\": \"Percentage\"}, {\"id\": 197,\"name\": \"Pie-chart\"}, {\"id\": 224,\"name\": \"Pipes and Cistern\"}, {\"id\": 7,\"name\": \"Problem on Age Calculation\"}, {\"id\": 211,\"name\": \"Problem on Ages\"}, {\"id\": 225,\"name\": \"Problem on Trains\"}, {\"id\": 40,\"name\": \"Profit and Loss\"}, {\"id\": 178,\"name\": \"Quadrilaterals\"}, {\"id\": 226,\"name\": \"Races & Games\"}, {\"id\": 35,\"name\": \"Ratio and Proportions\"}, {\"id\": 185,\"name\": \"Rectangular Parallelepiped\"}, {\"id\": 179,\"name\": \"Regular Polygons\"}, {\"id\": 186,\"name\": \"Regular Right Pyramid\"}, {\"id\": 168,\"name\": \"Relationship between numbers\"}, {\"id\": 181,\"name\": \"Right Circular Cone\"}, {\"id\": 182,\"name\": \"Right Circular Cylinder\"}, {\"id\": 180,\"name\": \"Right Prism\"}, {\"id\": 65,\"name\": \"Science, Inventions and Disco\"}, {\"id\": 217,\"name\": \"Seating Arrangement\"}, {\"id\": 206,\"name\": \"Security Tools\"}, {\"id\": 235,\"name\": \"Selecting Words\"}, {\"id\": 236,\"name\": \"Sentence Improvement\"}, {\"id\": 51,\"name\": \"Sentence Rearrangement\"}, {\"id\": 42,\"name\": \"Simple and Compound Interest\"}, {\"id\": 33,\"name\": \"Simplification\"}, {\"id\": 201,\"name\": \"Software\"}, {\"id\": 237,\"name\": \"Spelling\"}, {\"id\": 183,\"name\": \"Sphere\"}, {\"id\": 62,\"name\": \"Sports\"}, {\"id\": 169,\"name\": \"Square roots\"}, {\"id\": 190,\"name\": \"Standard Identities\"}, {\"id\": 243,\"name\": \"Statement and Argument\"}, {\"id\": 244,\"name\": \"Statement and Assumption\"}, {\"id\": 245,\"name\": \"Statement and Conclusion\"}, {\"id\": 193,\"name\": \"Statistical Charts\"}, {\"id\": 227,\"name\": \"Stocks & Shares\"}, {\"id\": 48,\"name\": \"Subject Verb Agreement\"}, {\"id\": 218,\"name\": \"Syllogism\"}, {\"id\": 56,\"name\": \"Synonyms\"}, {\"id\": 265,\"name\": \"System Analysis and Design\"}, {\"id\": 253,\"name\": \"Technology\"}, {\"id\": 50,\"name\": \"Tenses\"}, {\"id\": 3,\"name\": \"Test of Direction Sense\"}, {\"id\": 38,\"name\": \"Time and Distance\"}, {\"id\": 39,\"name\": \"Time and Work\"}, {\"id\": 175,\"name\": \"Triangle \"}, {\"id\": 188,\"name\": \"Trigonometric ratios\"}, {\"id\": 187,\"name\": \"Trigonometry\"}, {\"id\": 36,\"name\": \"Unitary Method\"}, {\"id\": 266,\"name\": \"Unix\"}, {\"id\": 54,\"name\": \"Unseen Passages\"}, {\"id\": 219,\"name\": \"Venn Diagram\"}, {\"id\": 46,\"name\": \"Verb\"}, {\"id\": 212,\"name\": \"Verbal classificatin\"}, {\"id\": 213,\"name\": \"Verification Of Truth\"}, {\"id\": 55,\"name\": \"Vocabulary\"}, {\"id\": 61,\"name\": \"Who is Who\"}, {\"id\": 267,\"name\": \"Windows 2000 Server\"}, {\"id\": 232,\"name\": \"Word Substitution\"}]";
$topicsArr = json_decode($topicsStr);

foreach($topicsArr as $topic){
    echo $topic->id . " " . $topic->name . "\n";
    $URL = "https://www.google.co.in/search?q=".str_replace(" ","+",$topic->name)."&ie=utf-8&oe=utf-8&gws_rd=cr&tbm=vid";
//echo $URL;
    $homepage = file_get_contents($URL);
    $urls = explode('/url?q=',$homepage);
    for($i = 1; $i<count($urls);$i++) {
        $topic->url = explode('&amp;', $urls[$i])[0];
        echo $topic->url . "\n";

        postQuestion($topic,$topic->id);

    }
    //die();

}