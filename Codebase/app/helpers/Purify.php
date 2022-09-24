<?php

namespace brickspace\helpers;

class Purify {
  /**
   * Purify and profanity filter text.
   */
  public static function purify($text) {
    $text = htmlspecialchars($text);
    $text = Purify::filter($text);
    return $text;
  }
  private static function filter($text) {
    $filterWords = array(
      "nigger",
      "niglet",
      "bldn",
      "brick luke deez nuts",
      "faggot",
      "cunt",
      "dickwad",
      "furfag",
      "russian pig",
      "rigging",
      "fag",
      "swine",
      "cracker",
      "squaw",
      "nigga",
      "mong",
      "cock and ball torture",
      "cbt",
      "isaac hymer",
      "spacebuilder",
      "brick luke",
      "brick-luke",
      "brick-hill",
      "brickhill",
      "porn",
      "ejaculation",
      "cum",
      "sperm",
      "semen",
      "cowgirl",
      "blowjob",
      "doggly style",
      "pornography",
      "jacking off",
      "jerking off",
      "sex",
      "pornhub",
      "stripper",
      "prostitute",
      "xvideos",
      "e621",
      "rule34",
      ".onion",
      "wanker",
      "hitler",
      "rule34.xxx",
      "e621.net",
      "brick luke deez",
      "brick deez luke nutz",
      "mentally retarded",
      "mommy milker",
      // Roblox clones
      "brickplanet",
      "bopimo",
      "worldtobuild",
      "polytoria",
      "xxx"
    );

    $filterCount = sizeof($filterWords);
    for ($i = 0; $i < $filterCount; $i++) {
      $text = preg_replace_callback('/\b' . $filterWords[$i] . '/i', function ($matches) {
        return str_repeat('*', strlen($matches[0]));
      }, $text);
    }
    return $text;
  }
}