function r(r) {
    for (var e = 1; e < r.length; e++) r[e][0] += r[e - 1][0] + 1;
    return r;
}

Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = new Map(r([ [ 9, "&Tab;" ], [ 0, "&NewLine;" ], [ 22, "&excl;" ], [ 0, "&quot;" ], [ 0, "&num;" ], [ 0, "&dollar;" ], [ 0, "&percnt;" ], [ 0, "&amp;" ], [ 0, "&apos;" ], [ 0, "&lpar;" ], [ 0, "&rpar;" ], [ 0, "&ast;" ], [ 0, "&plus;" ], [ 0, "&comma;" ], [ 1, "&period;" ], [ 0, "&sol;" ], [ 10, "&colon;" ], [ 0, "&semi;" ], [ 0, {
    v: "&lt;",
    n: 8402,
    o: "&nvlt;"
} ], [ 0, {
    v: "&equals;",
    n: 8421,
    o: "&bne;"
} ], [ 0, {
    v: "&gt;",
    n: 8402,
    o: "&nvgt;"
} ], [ 0, "&quest;" ], [ 0, "&commat;" ], [ 26, "&lbrack;" ], [ 0, "&bsol;" ], [ 0, "&rbrack;" ], [ 0, "&Hat;" ], [ 0, "&lowbar;" ], [ 0, "&DiacriticalGrave;" ], [ 5, {
    n: 106,
    o: "&fjlig;"
} ], [ 20, "&lbrace;" ], [ 0, "&verbar;" ], [ 0, "&rbrace;" ], [ 34, "&nbsp;" ], [ 0, "&iexcl;" ], [ 0, "&cent;" ], [ 0, "&pound;" ], [ 0, "&curren;" ], [ 0, "&yen;" ], [ 0, "&brvbar;" ], [ 0, "&sect;" ], [ 0, "&die;" ], [ 0, "&copy;" ], [ 0, "&ordf;" ], [ 0, "&laquo;" ], [ 0, "&not;" ], [ 0, "&shy;" ], [ 0, "&circledR;" ], [ 0, "&macr;" ], [ 0, "&deg;" ], [ 0, "&PlusMinus;" ], [ 0, "&sup2;" ], [ 0, "&sup3;" ], [ 0, "&acute;" ], [ 0, "&micro;" ], [ 0, "&para;" ], [ 0, "&centerdot;" ], [ 0, "&cedil;" ], [ 0, "&sup1;" ], [ 0, "&ordm;" ], [ 0, "&raquo;" ], [ 0, "&frac14;" ], [ 0, "&frac12;" ], [ 0, "&frac34;" ], [ 0, "&iquest;" ], [ 0, "&Agrave;" ], [ 0, "&Aacute;" ], [ 0, "&Acirc;" ], [ 0, "&Atilde;" ], [ 0, "&Auml;" ], [ 0, "&angst;" ], [ 0, "&AElig;" ], [ 0, "&Ccedil;" ], [ 0, "&Egrave;" ], [ 0, "&Eacute;" ], [ 0, "&Ecirc;" ], [ 0, "&Euml;" ], [ 0, "&Igrave;" ], [ 0, "&Iacute;" ], [ 0, "&Icirc;" ], [ 0, "&Iuml;" ], [ 0, "&ETH;" ], [ 0, "&Ntilde;" ], [ 0, "&Ograve;" ], [ 0, "&Oacute;" ], [ 0, "&Ocirc;" ], [ 0, "&Otilde;" ], [ 0, "&Ouml;" ], [ 0, "&times;" ], [ 0, "&Oslash;" ], [ 0, "&Ugrave;" ], [ 0, "&Uacute;" ], [ 0, "&Ucirc;" ], [ 0, "&Uuml;" ], [ 0, "&Yacute;" ], [ 0, "&THORN;" ], [ 0, "&szlig;" ], [ 0, "&agrave;" ], [ 0, "&aacute;" ], [ 0, "&acirc;" ], [ 0, "&atilde;" ], [ 0, "&auml;" ], [ 0, "&aring;" ], [ 0, "&aelig;" ], [ 0, "&ccedil;" ], [ 0, "&egrave;" ], [ 0, "&eacute;" ], [ 0, "&ecirc;" ], [ 0, "&euml;" ], [ 0, "&igrave;" ], [ 0, "&iacute;" ], [ 0, "&icirc;" ], [ 0, "&iuml;" ], [ 0, "&eth;" ], [ 0, "&ntilde;" ], [ 0, "&ograve;" ], [ 0, "&oacute;" ], [ 0, "&ocirc;" ], [ 0, "&otilde;" ], [ 0, "&ouml;" ], [ 0, "&div;" ], [ 0, "&oslash;" ], [ 0, "&ugrave;" ], [ 0, "&uacute;" ], [ 0, "&ucirc;" ], [ 0, "&uuml;" ], [ 0, "&yacute;" ], [ 0, "&thorn;" ], [ 0, "&yuml;" ], [ 0, "&Amacr;" ], [ 0, "&amacr;" ], [ 0, "&Abreve;" ], [ 0, "&abreve;" ], [ 0, "&Aogon;" ], [ 0, "&aogon;" ], [ 0, "&Cacute;" ], [ 0, "&cacute;" ], [ 0, "&Ccirc;" ], [ 0, "&ccirc;" ], [ 0, "&Cdot;" ], [ 0, "&cdot;" ], [ 0, "&Ccaron;" ], [ 0, "&ccaron;" ], [ 0, "&Dcaron;" ], [ 0, "&dcaron;" ], [ 0, "&Dstrok;" ], [ 0, "&dstrok;" ], [ 0, "&Emacr;" ], [ 0, "&emacr;" ], [ 2, "&Edot;" ], [ 0, "&edot;" ], [ 0, "&Eogon;" ], [ 0, "&eogon;" ], [ 0, "&Ecaron;" ], [ 0, "&ecaron;" ], [ 0, "&Gcirc;" ], [ 0, "&gcirc;" ], [ 0, "&Gbreve;" ], [ 0, "&gbreve;" ], [ 0, "&Gdot;" ], [ 0, "&gdot;" ], [ 0, "&Gcedil;" ], [ 1, "&Hcirc;" ], [ 0, "&hcirc;" ], [ 0, "&Hstrok;" ], [ 0, "&hstrok;" ], [ 0, "&Itilde;" ], [ 0, "&itilde;" ], [ 0, "&Imacr;" ], [ 0, "&imacr;" ], [ 2, "&Iogon;" ], [ 0, "&iogon;" ], [ 0, "&Idot;" ], [ 0, "&imath;" ], [ 0, "&IJlig;" ], [ 0, "&ijlig;" ], [ 0, "&Jcirc;" ], [ 0, "&jcirc;" ], [ 0, "&Kcedil;" ], [ 0, "&kcedil;" ], [ 0, "&kgreen;" ], [ 0, "&Lacute;" ], [ 0, "&lacute;" ], [ 0, "&Lcedil;" ], [ 0, "&lcedil;" ], [ 0, "&Lcaron;" ], [ 0, "&lcaron;" ], [ 0, "&Lmidot;" ], [ 0, "&lmidot;" ], [ 0, "&Lstrok;" ], [ 0, "&lstrok;" ], [ 0, "&Nacute;" ], [ 0, "&nacute;" ], [ 0, "&Ncedil;" ], [ 0, "&ncedil;" ], [ 0, "&Ncaron;" ], [ 0, "&ncaron;" ], [ 0, "&napos;" ], [ 0, "&ENG;" ], [ 0, "&eng;" ], [ 0, "&Omacr;" ], [ 0, "&omacr;" ], [ 2, "&Odblac;" ], [ 0, "&odblac;" ], [ 0, "&OElig;" ], [ 0, "&oelig;" ], [ 0, "&Racute;" ], [ 0, "&racute;" ], [ 0, "&Rcedil;" ], [ 0, "&rcedil;" ], [ 0, "&Rcaron;" ], [ 0, "&rcaron;" ], [ 0, "&Sacute;" ], [ 0, "&sacute;" ], [ 0, "&Scirc;" ], [ 0, "&scirc;" ], [ 0, "&Scedil;" ], [ 0, "&scedil;" ], [ 0, "&Scaron;" ], [ 0, "&scaron;" ], [ 0, "&Tcedil;" ], [ 0, "&tcedil;" ], [ 0, "&Tcaron;" ], [ 0, "&tcaron;" ], [ 0, "&Tstrok;" ], [ 0, "&tstrok;" ], [ 0, "&Utilde;" ], [ 0, "&utilde;" ], [ 0, "&Umacr;" ], [ 0, "&umacr;" ], [ 0, "&Ubreve;" ], [ 0, "&ubreve;" ], [ 0, "&Uring;" ], [ 0, "&uring;" ], [ 0, "&Udblac;" ], [ 0, "&udblac;" ], [ 0, "&Uogon;" ], [ 0, "&uogon;" ], [ 0, "&Wcirc;" ], [ 0, "&wcirc;" ], [ 0, "&Ycirc;" ], [ 0, "&ycirc;" ], [ 0, "&Yuml;" ], [ 0, "&Zacute;" ], [ 0, "&zacute;" ], [ 0, "&Zdot;" ], [ 0, "&zdot;" ], [ 0, "&Zcaron;" ], [ 0, "&zcaron;" ], [ 19, "&fnof;" ], [ 34, "&imped;" ], [ 63, "&gacute;" ], [ 65, "&jmath;" ], [ 142, "&circ;" ], [ 0, "&caron;" ], [ 16, "&breve;" ], [ 0, "&DiacriticalDot;" ], [ 0, "&ring;" ], [ 0, "&ogon;" ], [ 0, "&DiacriticalTilde;" ], [ 0, "&dblac;" ], [ 51, "&DownBreve;" ], [ 127, "&Alpha;" ], [ 0, "&Beta;" ], [ 0, "&Gamma;" ], [ 0, "&Delta;" ], [ 0, "&Epsilon;" ], [ 0, "&Zeta;" ], [ 0, "&Eta;" ], [ 0, "&Theta;" ], [ 0, "&Iota;" ], [ 0, "&Kappa;" ], [ 0, "&Lambda;" ], [ 0, "&Mu;" ], [ 0, "&Nu;" ], [ 0, "&Xi;" ], [ 0, "&Omicron;" ], [ 0, "&Pi;" ], [ 0, "&Rho;" ], [ 1, "&Sigma;" ], [ 0, "&Tau;" ], [ 0, "&Upsilon;" ], [ 0, "&Phi;" ], [ 0, "&Chi;" ], [ 0, "&Psi;" ], [ 0, "&ohm;" ], [ 7, "&alpha;" ], [ 0, "&beta;" ], [ 0, "&gamma;" ], [ 0, "&delta;" ], [ 0, "&epsi;" ], [ 0, "&zeta;" ], [ 0, "&eta;" ], [ 0, "&theta;" ], [ 0, "&iota;" ], [ 0, "&kappa;" ], [ 0, "&lambda;" ], [ 0, "&mu;" ], [ 0, "&nu;" ], [ 0, "&xi;" ], [ 0, "&omicron;" ], [ 0, "&pi;" ], [ 0, "&rho;" ], [ 0, "&sigmaf;" ], [ 0, "&sigma;" ], [ 0, "&tau;" ], [ 0, "&upsi;" ], [ 0, "&phi;" ], [ 0, "&chi;" ], [ 0, "&psi;" ], [ 0, "&omega;" ], [ 7, "&thetasym;" ], [ 0, "&Upsi;" ], [ 2, "&phiv;" ], [ 0, "&piv;" ], [ 5, "&Gammad;" ], [ 0, "&digamma;" ], [ 18, "&kappav;" ], [ 0, "&rhov;" ], [ 3, "&epsiv;" ], [ 0, "&backepsilon;" ], [ 10, "&IOcy;" ], [ 0, "&DJcy;" ], [ 0, "&GJcy;" ], [ 0, "&Jukcy;" ], [ 0, "&DScy;" ], [ 0, "&Iukcy;" ], [ 0, "&YIcy;" ], [ 0, "&Jsercy;" ], [ 0, "&LJcy;" ], [ 0, "&NJcy;" ], [ 0, "&TSHcy;" ], [ 0, "&KJcy;" ], [ 1, "&Ubrcy;" ], [ 0, "&DZcy;" ], [ 0, "&Acy;" ], [ 0, "&Bcy;" ], [ 0, "&Vcy;" ], [ 0, "&Gcy;" ], [ 0, "&Dcy;" ], [ 0, "&IEcy;" ], [ 0, "&ZHcy;" ], [ 0, "&Zcy;" ], [ 0, "&Icy;" ], [ 0, "&Jcy;" ], [ 0, "&Kcy;" ], [ 0, "&Lcy;" ], [ 0, "&Mcy;" ], [ 0, "&Ncy;" ], [ 0, "&Ocy;" ], [ 0, "&Pcy;" ], [ 0, "&Rcy;" ], [ 0, "&Scy;" ], [ 0, "&Tcy;" ], [ 0, "&Ucy;" ], [ 0, "&Fcy;" ], [ 0, "&KHcy;" ], [ 0, "&TScy;" ], [ 0, "&CHcy;" ], [ 0, "&SHcy;" ], [ 0, "&SHCHcy;" ], [ 0, "&HARDcy;" ], [ 0, "&Ycy;" ], [ 0, "&SOFTcy;" ], [ 0, "&Ecy;" ], [ 0, "&YUcy;" ], [ 0, "&YAcy;" ], [ 0, "&acy;" ], [ 0, "&bcy;" ], [ 0, "&vcy;" ], [ 0, "&gcy;" ], [ 0, "&dcy;" ], [ 0, "&iecy;" ], [ 0, "&zhcy;" ], [ 0, "&zcy;" ], [ 0, "&icy;" ], [ 0, "&jcy;" ], [ 0, "&kcy;" ], [ 0, "&lcy;" ], [ 0, "&mcy;" ], [ 0, "&ncy;" ], [ 0, "&ocy;" ], [ 0, "&pcy;" ], [ 0, "&rcy;" ], [ 0, "&scy;" ], [ 0, "&tcy;" ], [ 0, "&ucy;" ], [ 0, "&fcy;" ], [ 0, "&khcy;" ], [ 0, "&tscy;" ], [ 0, "&chcy;" ], [ 0, "&shcy;" ], [ 0, "&shchcy;" ], [ 0, "&hardcy;" ], [ 0, "&ycy;" ], [ 0, "&softcy;" ], [ 0, "&ecy;" ], [ 0, "&yucy;" ], [ 0, "&yacy;" ], [ 1, "&iocy;" ], [ 0, "&djcy;" ], [ 0, "&gjcy;" ], [ 0, "&jukcy;" ], [ 0, "&dscy;" ], [ 0, "&iukcy;" ], [ 0, "&yicy;" ], [ 0, "&jsercy;" ], [ 0, "&ljcy;" ], [ 0, "&njcy;" ], [ 0, "&tshcy;" ], [ 0, "&kjcy;" ], [ 1, "&ubrcy;" ], [ 0, "&dzcy;" ], [ 7074, "&ensp;" ], [ 0, "&emsp;" ], [ 0, "&emsp13;" ], [ 0, "&emsp14;" ], [ 1, "&numsp;" ], [ 0, "&puncsp;" ], [ 0, "&ThinSpace;" ], [ 0, "&hairsp;" ], [ 0, "&NegativeMediumSpace;" ], [ 0, "&zwnj;" ], [ 0, "&zwj;" ], [ 0, "&lrm;" ], [ 0, "&rlm;" ], [ 0, "&dash;" ], [ 2, "&ndash;" ], [ 0, "&mdash;" ], [ 0, "&horbar;" ], [ 0, "&Verbar;" ], [ 1, "&lsquo;" ], [ 0, "&CloseCurlyQuote;" ], [ 0, "&lsquor;" ], [ 1, "&ldquo;" ], [ 0, "&CloseCurlyDoubleQuote;" ], [ 0, "&bdquo;" ], [ 1, "&dagger;" ], [ 0, "&Dagger;" ], [ 0, "&bull;" ], [ 2, "&nldr;" ], [ 0, "&hellip;" ], [ 9, "&permil;" ], [ 0, "&pertenk;" ], [ 0, "&prime;" ], [ 0, "&Prime;" ], [ 0, "&tprime;" ], [ 0, "&backprime;" ], [ 3, "&lsaquo;" ], [ 0, "&rsaquo;" ], [ 3, "&oline;" ], [ 2, "&caret;" ], [ 1, "&hybull;" ], [ 0, "&frasl;" ], [ 10, "&bsemi;" ], [ 7, "&qprime;" ], [ 7, {
    v: "&MediumSpace;",
    n: 8202,
    o: "&ThickSpace;"
} ], [ 0, "&NoBreak;" ], [ 0, "&af;" ], [ 0, "&InvisibleTimes;" ], [ 0, "&ic;" ], [ 72, "&euro;" ], [ 46, "&tdot;" ], [ 0, "&DotDot;" ], [ 37, "&complexes;" ], [ 2, "&incare;" ], [ 4, "&gscr;" ], [ 0, "&hamilt;" ], [ 0, "&Hfr;" ], [ 0, "&Hopf;" ], [ 0, "&planckh;" ], [ 0, "&hbar;" ], [ 0, "&imagline;" ], [ 0, "&Ifr;" ], [ 0, "&lagran;" ], [ 0, "&ell;" ], [ 1, "&naturals;" ], [ 0, "&numero;" ], [ 0, "&copysr;" ], [ 0, "&weierp;" ], [ 0, "&Popf;" ], [ 0, "&Qopf;" ], [ 0, "&realine;" ], [ 0, "&real;" ], [ 0, "&reals;" ], [ 0, "&rx;" ], [ 3, "&trade;" ], [ 1, "&integers;" ], [ 2, "&mho;" ], [ 0, "&zeetrf;" ], [ 0, "&iiota;" ], [ 2, "&bernou;" ], [ 0, "&Cayleys;" ], [ 1, "&escr;" ], [ 0, "&Escr;" ], [ 0, "&Fouriertrf;" ], [ 1, "&Mellintrf;" ], [ 0, "&order;" ], [ 0, "&alefsym;" ], [ 0, "&beth;" ], [ 0, "&gimel;" ], [ 0, "&daleth;" ], [ 12, "&CapitalDifferentialD;" ], [ 0, "&dd;" ], [ 0, "&ee;" ], [ 0, "&ii;" ], [ 10, "&frac13;" ], [ 0, "&frac23;" ], [ 0, "&frac15;" ], [ 0, "&frac25;" ], [ 0, "&frac35;" ], [ 0, "&frac45;" ], [ 0, "&frac16;" ], [ 0, "&frac56;" ], [ 0, "&frac18;" ], [ 0, "&frac38;" ], [ 0, "&frac58;" ], [ 0, "&frac78;" ], [ 49, "&larr;" ], [ 0, "&ShortUpArrow;" ], [ 0, "&rarr;" ], [ 0, "&darr;" ], [ 0, "&harr;" ], [ 0, "&updownarrow;" ], [ 0, "&nwarr;" ], [ 0, "&nearr;" ], [ 0, "&LowerRightArrow;" ], [ 0, "&LowerLeftArrow;" ], [ 0, "&nlarr;" ], [ 0, "&nrarr;" ], [ 1, {
    v: "&rarrw;",
    n: 824,
    o: "&nrarrw;"
} ], [ 0, "&Larr;" ], [ 0, "&Uarr;" ], [ 0, "&Rarr;" ], [ 0, "&Darr;" ], [ 0, "&larrtl;" ], [ 0, "&rarrtl;" ], [ 0, "&LeftTeeArrow;" ], [ 0, "&mapstoup;" ], [ 0, "&map;" ], [ 0, "&DownTeeArrow;" ], [ 1, "&hookleftarrow;" ], [ 0, "&hookrightarrow;" ], [ 0, "&larrlp;" ], [ 0, "&looparrowright;" ], [ 0, "&harrw;" ], [ 0, "&nharr;" ], [ 1, "&lsh;" ], [ 0, "&rsh;" ], [ 0, "&ldsh;" ], [ 0, "&rdsh;" ], [ 1, "&crarr;" ], [ 0, "&cularr;" ], [ 0, "&curarr;" ], [ 2, "&circlearrowleft;" ], [ 0, "&circlearrowright;" ], [ 0, "&leftharpoonup;" ], [ 0, "&DownLeftVector;" ], [ 0, "&RightUpVector;" ], [ 0, "&LeftUpVector;" ], [ 0, "&rharu;" ], [ 0, "&DownRightVector;" ], [ 0, "&dharr;" ], [ 0, "&dharl;" ], [ 0, "&RightArrowLeftArrow;" ], [ 0, "&udarr;" ], [ 0, "&LeftArrowRightArrow;" ], [ 0, "&leftleftarrows;" ], [ 0, "&upuparrows;" ], [ 0, "&rightrightarrows;" ], [ 0, "&ddarr;" ], [ 0, "&leftrightharpoons;" ], [ 0, "&Equilibrium;" ], [ 0, "&nlArr;" ], [ 0, "&nhArr;" ], [ 0, "&nrArr;" ], [ 0, "&DoubleLeftArrow;" ], [ 0, "&DoubleUpArrow;" ], [ 0, "&DoubleRightArrow;" ], [ 0, "&dArr;" ], [ 0, "&DoubleLeftRightArrow;" ], [ 0, "&DoubleUpDownArrow;" ], [ 0, "&nwArr;" ], [ 0, "&neArr;" ], [ 0, "&seArr;" ], [ 0, "&swArr;" ], [ 0, "&lAarr;" ], [ 0, "&rAarr;" ], [ 1, "&zigrarr;" ], [ 6, "&larrb;" ], [ 0, "&rarrb;" ], [ 15, "&DownArrowUpArrow;" ], [ 7, "&loarr;" ], [ 0, "&roarr;" ], [ 0, "&hoarr;" ], [ 0, "&forall;" ], [ 0, "&comp;" ], [ 0, {
    v: "&part;",
    n: 824,
    o: "&npart;"
} ], [ 0, "&exist;" ], [ 0, "&nexist;" ], [ 0, "&empty;" ], [ 1, "&Del;" ], [ 0, "&Element;" ], [ 0, "&NotElement;" ], [ 1, "&ni;" ], [ 0, "&notni;" ], [ 2, "&prod;" ], [ 0, "&coprod;" ], [ 0, "&sum;" ], [ 0, "&minus;" ], [ 0, "&MinusPlus;" ], [ 0, "&dotplus;" ], [ 1, "&Backslash;" ], [ 0, "&lowast;" ], [ 0, "&compfn;" ], [ 1, "&radic;" ], [ 2, "&prop;" ], [ 0, "&infin;" ], [ 0, "&angrt;" ], [ 0, {
    v: "&ang;",
    n: 8402,
    o: "&nang;"
} ], [ 0, "&angmsd;" ], [ 0, "&angsph;" ], [ 0, "&mid;" ], [ 0, "&nmid;" ], [ 0, "&DoubleVerticalBar;" ], [ 0, "&NotDoubleVerticalBar;" ], [ 0, "&and;" ], [ 0, "&or;" ], [ 0, {
    v: "&cap;",
    n: 65024,
    o: "&caps;"
} ], [ 0, {
    v: "&cup;",
    n: 65024,
    o: "&cups;"
} ], [ 0, "&int;" ], [ 0, "&Int;" ], [ 0, "&iiint;" ], [ 0, "&conint;" ], [ 0, "&Conint;" ], [ 0, "&Cconint;" ], [ 0, "&cwint;" ], [ 0, "&ClockwiseContourIntegral;" ], [ 0, "&awconint;" ], [ 0, "&there4;" ], [ 0, "&becaus;" ], [ 0, "&ratio;" ], [ 0, "&Colon;" ], [ 0, "&dotminus;" ], [ 1, "&mDDot;" ], [ 0, "&homtht;" ], [ 0, {
    v: "&sim;",
    n: 8402,
    o: "&nvsim;"
} ], [ 0, {
    v: "&backsim;",
    n: 817,
    o: "&race;"
} ], [ 0, {
    v: "&ac;",
    n: 819,
    o: "&acE;"
} ], [ 0, "&acd;" ], [ 0, "&VerticalTilde;" ], [ 0, "&NotTilde;" ], [ 0, {
    v: "&eqsim;",
    n: 824,
    o: "&nesim;"
} ], [ 0, "&sime;" ], [ 0, "&NotTildeEqual;" ], [ 0, "&cong;" ], [ 0, "&simne;" ], [ 0, "&ncong;" ], [ 0, "&ap;" ], [ 0, "&nap;" ], [ 0, "&ape;" ], [ 0, {
    v: "&apid;",
    n: 824,
    o: "&napid;"
} ], [ 0, "&backcong;" ], [ 0, {
    v: "&asympeq;",
    n: 8402,
    o: "&nvap;"
} ], [ 0, {
    v: "&bump;",
    n: 824,
    o: "&nbump;"
} ], [ 0, {
    v: "&bumpe;",
    n: 824,
    o: "&nbumpe;"
} ], [ 0, {
    v: "&doteq;",
    n: 824,
    o: "&nedot;"
} ], [ 0, "&doteqdot;" ], [ 0, "&efDot;" ], [ 0, "&erDot;" ], [ 0, "&Assign;" ], [ 0, "&ecolon;" ], [ 0, "&ecir;" ], [ 0, "&circeq;" ], [ 1, "&wedgeq;" ], [ 0, "&veeeq;" ], [ 1, "&triangleq;" ], [ 2, "&equest;" ], [ 0, "&ne;" ], [ 0, {
    v: "&Congruent;",
    n: 8421,
    o: "&bnequiv;"
} ], [ 0, "&nequiv;" ], [ 1, {
    v: "&le;",
    n: 8402,
    o: "&nvle;"
} ], [ 0, {
    v: "&ge;",
    n: 8402,
    o: "&nvge;"
} ], [ 0, {
    v: "&lE;",
    n: 824,
    o: "&nlE;"
} ], [ 0, {
    v: "&gE;",
    n: 824,
    o: "&ngE;"
} ], [ 0, {
    v: "&lnE;",
    n: 65024,
    o: "&lvertneqq;"
} ], [ 0, {
    v: "&gnE;",
    n: 65024,
    o: "&gvertneqq;"
} ], [ 0, {
    v: "&ll;",
    n: new Map(r([ [ 824, "&nLtv;" ], [ 7577, "&nLt;" ] ]))
} ], [ 0, {
    v: "&gg;",
    n: new Map(r([ [ 824, "&nGtv;" ], [ 7577, "&nGt;" ] ]))
} ], [ 0, "&between;" ], [ 0, "&NotCupCap;" ], [ 0, "&nless;" ], [ 0, "&ngt;" ], [ 0, "&nle;" ], [ 0, "&nge;" ], [ 0, "&lesssim;" ], [ 0, "&GreaterTilde;" ], [ 0, "&nlsim;" ], [ 0, "&ngsim;" ], [ 0, "&LessGreater;" ], [ 0, "&gl;" ], [ 0, "&NotLessGreater;" ], [ 0, "&NotGreaterLess;" ], [ 0, "&pr;" ], [ 0, "&sc;" ], [ 0, "&prcue;" ], [ 0, "&sccue;" ], [ 0, "&PrecedesTilde;" ], [ 0, {
    v: "&scsim;",
    n: 824,
    o: "&NotSucceedsTilde;"
} ], [ 0, "&NotPrecedes;" ], [ 0, "&NotSucceeds;" ], [ 0, {
    v: "&sub;",
    n: 8402,
    o: "&NotSubset;"
} ], [ 0, {
    v: "&sup;",
    n: 8402,
    o: "&NotSuperset;"
} ], [ 0, "&nsub;" ], [ 0, "&nsup;" ], [ 0, "&sube;" ], [ 0, "&supe;" ], [ 0, "&NotSubsetEqual;" ], [ 0, "&NotSupersetEqual;" ], [ 0, {
    v: "&subne;",
    n: 65024,
    o: "&varsubsetneq;"
} ], [ 0, {
    v: "&supne;",
    n: 65024,
    o: "&varsupsetneq;"
} ], [ 1, "&cupdot;" ], [ 0, "&UnionPlus;" ], [ 0, {
    v: "&sqsub;",
    n: 824,
    o: "&NotSquareSubset;"
} ], [ 0, {
    v: "&sqsup;",
    n: 824,
    o: "&NotSquareSuperset;"
} ], [ 0, "&sqsube;" ], [ 0, "&sqsupe;" ], [ 0, {
    v: "&sqcap;",
    n: 65024,
    o: "&sqcaps;"
} ], [ 0, {
    v: "&sqcup;",
    n: 65024,
    o: "&sqcups;"
} ], [ 0, "&CirclePlus;" ], [ 0, "&CircleMinus;" ], [ 0, "&CircleTimes;" ], [ 0, "&osol;" ], [ 0, "&CircleDot;" ], [ 0, "&circledcirc;" ], [ 0, "&circledast;" ], [ 1, "&circleddash;" ], [ 0, "&boxplus;" ], [ 0, "&boxminus;" ], [ 0, "&boxtimes;" ], [ 0, "&dotsquare;" ], [ 0, "&RightTee;" ], [ 0, "&dashv;" ], [ 0, "&DownTee;" ], [ 0, "&bot;" ], [ 1, "&models;" ], [ 0, "&DoubleRightTee;" ], [ 0, "&Vdash;" ], [ 0, "&Vvdash;" ], [ 0, "&VDash;" ], [ 0, "&nvdash;" ], [ 0, "&nvDash;" ], [ 0, "&nVdash;" ], [ 0, "&nVDash;" ], [ 0, "&prurel;" ], [ 1, "&LeftTriangle;" ], [ 0, "&RightTriangle;" ], [ 0, {
    v: "&LeftTriangleEqual;",
    n: 8402,
    o: "&nvltrie;"
} ], [ 0, {
    v: "&RightTriangleEqual;",
    n: 8402,
    o: "&nvrtrie;"
} ], [ 0, "&origof;" ], [ 0, "&imof;" ], [ 0, "&multimap;" ], [ 0, "&hercon;" ], [ 0, "&intcal;" ], [ 0, "&veebar;" ], [ 1, "&barvee;" ], [ 0, "&angrtvb;" ], [ 0, "&lrtri;" ], [ 0, "&bigwedge;" ], [ 0, "&bigvee;" ], [ 0, "&bigcap;" ], [ 0, "&bigcup;" ], [ 0, "&diam;" ], [ 0, "&sdot;" ], [ 0, "&sstarf;" ], [ 0, "&divideontimes;" ], [ 0, "&bowtie;" ], [ 0, "&ltimes;" ], [ 0, "&rtimes;" ], [ 0, "&leftthreetimes;" ], [ 0, "&rightthreetimes;" ], [ 0, "&backsimeq;" ], [ 0, "&curlyvee;" ], [ 0, "&curlywedge;" ], [ 0, "&Sub;" ], [ 0, "&Sup;" ], [ 0, "&Cap;" ], [ 0, "&Cup;" ], [ 0, "&fork;" ], [ 0, "&epar;" ], [ 0, "&lessdot;" ], [ 0, "&gtdot;" ], [ 0, {
    v: "&Ll;",
    n: 824,
    o: "&nLl;"
} ], [ 0, {
    v: "&Gg;",
    n: 824,
    o: "&nGg;"
} ], [ 0, {
    v: "&leg;",
    n: 65024,
    o: "&lesg;"
} ], [ 0, {
    v: "&gel;",
    n: 65024,
    o: "&gesl;"
} ], [ 2, "&cuepr;" ], [ 0, "&cuesc;" ], [ 0, "&NotPrecedesSlantEqual;" ], [ 0, "&NotSucceedsSlantEqual;" ], [ 0, "&NotSquareSubsetEqual;" ], [ 0, "&NotSquareSupersetEqual;" ], [ 2, "&lnsim;" ], [ 0, "&gnsim;" ], [ 0, "&precnsim;" ], [ 0, "&scnsim;" ], [ 0, "&nltri;" ], [ 0, "&NotRightTriangle;" ], [ 0, "&nltrie;" ], [ 0, "&NotRightTriangleEqual;" ], [ 0, "&vellip;" ], [ 0, "&ctdot;" ], [ 0, "&utdot;" ], [ 0, "&dtdot;" ], [ 0, "&disin;" ], [ 0, "&isinsv;" ], [ 0, "&isins;" ], [ 0, {
    v: "&isindot;",
    n: 824,
    o: "&notindot;"
} ], [ 0, "&notinvc;" ], [ 0, "&notinvb;" ], [ 1, {
    v: "&isinE;",
    n: 824,
    o: "&notinE;"
} ], [ 0, "&nisd;" ], [ 0, "&xnis;" ], [ 0, "&nis;" ], [ 0, "&notnivc;" ], [ 0, "&notnivb;" ], [ 6, "&barwed;" ], [ 0, "&Barwed;" ], [ 1, "&lceil;" ], [ 0, "&rceil;" ], [ 0, "&LeftFloor;" ], [ 0, "&rfloor;" ], [ 0, "&drcrop;" ], [ 0, "&dlcrop;" ], [ 0, "&urcrop;" ], [ 0, "&ulcrop;" ], [ 0, "&bnot;" ], [ 1, "&profline;" ], [ 0, "&profsurf;" ], [ 1, "&telrec;" ], [ 0, "&target;" ], [ 5, "&ulcorn;" ], [ 0, "&urcorn;" ], [ 0, "&dlcorn;" ], [ 0, "&drcorn;" ], [ 2, "&frown;" ], [ 0, "&smile;" ], [ 9, "&cylcty;" ], [ 0, "&profalar;" ], [ 7, "&topbot;" ], [ 6, "&ovbar;" ], [ 1, "&solbar;" ], [ 60, "&angzarr;" ], [ 51, "&lmoustache;" ], [ 0, "&rmoustache;" ], [ 2, "&OverBracket;" ], [ 0, "&bbrk;" ], [ 0, "&bbrktbrk;" ], [ 37, "&OverParenthesis;" ], [ 0, "&UnderParenthesis;" ], [ 0, "&OverBrace;" ], [ 0, "&UnderBrace;" ], [ 2, "&trpezium;" ], [ 4, "&elinters;" ], [ 59, "&blank;" ], [ 164, "&circledS;" ], [ 55, "&boxh;" ], [ 1, "&boxv;" ], [ 9, "&boxdr;" ], [ 3, "&boxdl;" ], [ 3, "&boxur;" ], [ 3, "&boxul;" ], [ 3, "&boxvr;" ], [ 7, "&boxvl;" ], [ 7, "&boxhd;" ], [ 7, "&boxhu;" ], [ 7, "&boxvh;" ], [ 19, "&boxH;" ], [ 0, "&boxV;" ], [ 0, "&boxdR;" ], [ 0, "&boxDr;" ], [ 0, "&boxDR;" ], [ 0, "&boxdL;" ], [ 0, "&boxDl;" ], [ 0, "&boxDL;" ], [ 0, "&boxuR;" ], [ 0, "&boxUr;" ], [ 0, "&boxUR;" ], [ 0, "&boxuL;" ], [ 0, "&boxUl;" ], [ 0, "&boxUL;" ], [ 0, "&boxvR;" ], [ 0, "&boxVr;" ], [ 0, "&boxVR;" ], [ 0, "&boxvL;" ], [ 0, "&boxVl;" ], [ 0, "&boxVL;" ], [ 0, "&boxHd;" ], [ 0, "&boxhD;" ], [ 0, "&boxHD;" ], [ 0, "&boxHu;" ], [ 0, "&boxhU;" ], [ 0, "&boxHU;" ], [ 0, "&boxvH;" ], [ 0, "&boxVh;" ], [ 0, "&boxVH;" ], [ 19, "&uhblk;" ], [ 3, "&lhblk;" ], [ 3, "&block;" ], [ 8, "&blk14;" ], [ 0, "&blk12;" ], [ 0, "&blk34;" ], [ 13, "&square;" ], [ 8, "&blacksquare;" ], [ 0, "&EmptyVerySmallSquare;" ], [ 1, "&rect;" ], [ 0, "&marker;" ], [ 2, "&fltns;" ], [ 1, "&bigtriangleup;" ], [ 0, "&blacktriangle;" ], [ 0, "&triangle;" ], [ 2, "&blacktriangleright;" ], [ 0, "&rtri;" ], [ 3, "&bigtriangledown;" ], [ 0, "&blacktriangledown;" ], [ 0, "&dtri;" ], [ 2, "&blacktriangleleft;" ], [ 0, "&ltri;" ], [ 6, "&loz;" ], [ 0, "&cir;" ], [ 32, "&tridot;" ], [ 2, "&bigcirc;" ], [ 8, "&ultri;" ], [ 0, "&urtri;" ], [ 0, "&lltri;" ], [ 0, "&EmptySmallSquare;" ], [ 0, "&FilledSmallSquare;" ], [ 8, "&bigstar;" ], [ 0, "&star;" ], [ 7, "&phone;" ], [ 49, "&female;" ], [ 1, "&male;" ], [ 29, "&spades;" ], [ 2, "&clubs;" ], [ 1, "&hearts;" ], [ 0, "&diamondsuit;" ], [ 3, "&sung;" ], [ 2, "&flat;" ], [ 0, "&natural;" ], [ 0, "&sharp;" ], [ 163, "&check;" ], [ 3, "&cross;" ], [ 8, "&malt;" ], [ 21, "&sext;" ], [ 33, "&VerticalSeparator;" ], [ 25, "&lbbrk;" ], [ 0, "&rbbrk;" ], [ 84, "&bsolhsub;" ], [ 0, "&suphsol;" ], [ 28, "&LeftDoubleBracket;" ], [ 0, "&RightDoubleBracket;" ], [ 0, "&lang;" ], [ 0, "&rang;" ], [ 0, "&Lang;" ], [ 0, "&Rang;" ], [ 0, "&loang;" ], [ 0, "&roang;" ], [ 7, "&longleftarrow;" ], [ 0, "&longrightarrow;" ], [ 0, "&longleftrightarrow;" ], [ 0, "&DoubleLongLeftArrow;" ], [ 0, "&DoubleLongRightArrow;" ], [ 0, "&DoubleLongLeftRightArrow;" ], [ 1, "&longmapsto;" ], [ 2, "&dzigrarr;" ], [ 258, "&nvlArr;" ], [ 0, "&nvrArr;" ], [ 0, "&nvHarr;" ], [ 0, "&Map;" ], [ 6, "&lbarr;" ], [ 0, "&bkarow;" ], [ 0, "&lBarr;" ], [ 0, "&dbkarow;" ], [ 0, "&drbkarow;" ], [ 0, "&DDotrahd;" ], [ 0, "&UpArrowBar;" ], [ 0, "&DownArrowBar;" ], [ 2, "&Rarrtl;" ], [ 2, "&latail;" ], [ 0, "&ratail;" ], [ 0, "&lAtail;" ], [ 0, "&rAtail;" ], [ 0, "&larrfs;" ], [ 0, "&rarrfs;" ], [ 0, "&larrbfs;" ], [ 0, "&rarrbfs;" ], [ 2, "&nwarhk;" ], [ 0, "&nearhk;" ], [ 0, "&hksearow;" ], [ 0, "&hkswarow;" ], [ 0, "&nwnear;" ], [ 0, "&nesear;" ], [ 0, "&seswar;" ], [ 0, "&swnwar;" ], [ 8, {
    v: "&rarrc;",
    n: 824,
    o: "&nrarrc;"
} ], [ 1, "&cudarrr;" ], [ 0, "&ldca;" ], [ 0, "&rdca;" ], [ 0, "&cudarrl;" ], [ 0, "&larrpl;" ], [ 2, "&curarrm;" ], [ 0, "&cularrp;" ], [ 7, "&rarrpl;" ], [ 2, "&harrcir;" ], [ 0, "&Uarrocir;" ], [ 0, "&lurdshar;" ], [ 0, "&ldrushar;" ], [ 2, "&LeftRightVector;" ], [ 0, "&RightUpDownVector;" ], [ 0, "&DownLeftRightVector;" ], [ 0, "&LeftUpDownVector;" ], [ 0, "&LeftVectorBar;" ], [ 0, "&RightVectorBar;" ], [ 0, "&RightUpVectorBar;" ], [ 0, "&RightDownVectorBar;" ], [ 0, "&DownLeftVectorBar;" ], [ 0, "&DownRightVectorBar;" ], [ 0, "&LeftUpVectorBar;" ], [ 0, "&LeftDownVectorBar;" ], [ 0, "&LeftTeeVector;" ], [ 0, "&RightTeeVector;" ], [ 0, "&RightUpTeeVector;" ], [ 0, "&RightDownTeeVector;" ], [ 0, "&DownLeftTeeVector;" ], [ 0, "&DownRightTeeVector;" ], [ 0, "&LeftUpTeeVector;" ], [ 0, "&LeftDownTeeVector;" ], [ 0, "&lHar;" ], [ 0, "&uHar;" ], [ 0, "&rHar;" ], [ 0, "&dHar;" ], [ 0, "&luruhar;" ], [ 0, "&ldrdhar;" ], [ 0, "&ruluhar;" ], [ 0, "&rdldhar;" ], [ 0, "&lharul;" ], [ 0, "&llhard;" ], [ 0, "&rharul;" ], [ 0, "&lrhard;" ], [ 0, "&udhar;" ], [ 0, "&duhar;" ], [ 0, "&RoundImplies;" ], [ 0, "&erarr;" ], [ 0, "&simrarr;" ], [ 0, "&larrsim;" ], [ 0, "&rarrsim;" ], [ 0, "&rarrap;" ], [ 0, "&ltlarr;" ], [ 1, "&gtrarr;" ], [ 0, "&subrarr;" ], [ 1, "&suplarr;" ], [ 0, "&lfisht;" ], [ 0, "&rfisht;" ], [ 0, "&ufisht;" ], [ 0, "&dfisht;" ], [ 5, "&lopar;" ], [ 0, "&ropar;" ], [ 4, "&lbrke;" ], [ 0, "&rbrke;" ], [ 0, "&lbrkslu;" ], [ 0, "&rbrksld;" ], [ 0, "&lbrksld;" ], [ 0, "&rbrkslu;" ], [ 0, "&langd;" ], [ 0, "&rangd;" ], [ 0, "&lparlt;" ], [ 0, "&rpargt;" ], [ 0, "&gtlPar;" ], [ 0, "&ltrPar;" ], [ 3, "&vzigzag;" ], [ 1, "&vangrt;" ], [ 0, "&angrtvbd;" ], [ 6, "&ange;" ], [ 0, "&range;" ], [ 0, "&dwangle;" ], [ 0, "&uwangle;" ], [ 0, "&angmsdaa;" ], [ 0, "&angmsdab;" ], [ 0, "&angmsdac;" ], [ 0, "&angmsdad;" ], [ 0, "&angmsdae;" ], [ 0, "&angmsdaf;" ], [ 0, "&angmsdag;" ], [ 0, "&angmsdah;" ], [ 0, "&bemptyv;" ], [ 0, "&demptyv;" ], [ 0, "&cemptyv;" ], [ 0, "&raemptyv;" ], [ 0, "&laemptyv;" ], [ 0, "&ohbar;" ], [ 0, "&omid;" ], [ 0, "&opar;" ], [ 1, "&operp;" ], [ 1, "&olcross;" ], [ 0, "&odsold;" ], [ 1, "&olcir;" ], [ 0, "&ofcir;" ], [ 0, "&olt;" ], [ 0, "&ogt;" ], [ 0, "&cirscir;" ], [ 0, "&cirE;" ], [ 0, "&solb;" ], [ 0, "&bsolb;" ], [ 3, "&boxbox;" ], [ 3, "&trisb;" ], [ 0, "&rtriltri;" ], [ 0, {
    v: "&LeftTriangleBar;",
    n: 824,
    o: "&NotLeftTriangleBar;"
} ], [ 0, {
    v: "&RightTriangleBar;",
    n: 824,
    o: "&NotRightTriangleBar;"
} ], [ 11, "&iinfin;" ], [ 0, "&infintie;" ], [ 0, "&nvinfin;" ], [ 4, "&eparsl;" ], [ 0, "&smeparsl;" ], [ 0, "&eqvparsl;" ], [ 5, "&blacklozenge;" ], [ 8, "&RuleDelayed;" ], [ 1, "&dsol;" ], [ 9, "&bigodot;" ], [ 0, "&bigoplus;" ], [ 0, "&bigotimes;" ], [ 1, "&biguplus;" ], [ 1, "&bigsqcup;" ], [ 5, "&iiiint;" ], [ 0, "&fpartint;" ], [ 2, "&cirfnint;" ], [ 0, "&awint;" ], [ 0, "&rppolint;" ], [ 0, "&scpolint;" ], [ 0, "&npolint;" ], [ 0, "&pointint;" ], [ 0, "&quatint;" ], [ 0, "&intlarhk;" ], [ 10, "&pluscir;" ], [ 0, "&plusacir;" ], [ 0, "&simplus;" ], [ 0, "&plusdu;" ], [ 0, "&plussim;" ], [ 0, "&plustwo;" ], [ 1, "&mcomma;" ], [ 0, "&minusdu;" ], [ 2, "&loplus;" ], [ 0, "&roplus;" ], [ 0, "&Cross;" ], [ 0, "&timesd;" ], [ 0, "&timesbar;" ], [ 1, "&smashp;" ], [ 0, "&lotimes;" ], [ 0, "&rotimes;" ], [ 0, "&otimesas;" ], [ 0, "&Otimes;" ], [ 0, "&odiv;" ], [ 0, "&triplus;" ], [ 0, "&triminus;" ], [ 0, "&tritime;" ], [ 0, "&intprod;" ], [ 2, "&amalg;" ], [ 0, "&capdot;" ], [ 1, "&ncup;" ], [ 0, "&ncap;" ], [ 0, "&capand;" ], [ 0, "&cupor;" ], [ 0, "&cupcap;" ], [ 0, "&capcup;" ], [ 0, "&cupbrcap;" ], [ 0, "&capbrcup;" ], [ 0, "&cupcup;" ], [ 0, "&capcap;" ], [ 0, "&ccups;" ], [ 0, "&ccaps;" ], [ 2, "&ccupssm;" ], [ 2, "&And;" ], [ 0, "&Or;" ], [ 0, "&andand;" ], [ 0, "&oror;" ], [ 0, "&orslope;" ], [ 0, "&andslope;" ], [ 1, "&andv;" ], [ 0, "&orv;" ], [ 0, "&andd;" ], [ 0, "&ord;" ], [ 1, "&wedbar;" ], [ 6, "&sdote;" ], [ 3, "&simdot;" ], [ 2, {
    v: "&congdot;",
    n: 824,
    o: "&ncongdot;"
} ], [ 0, "&easter;" ], [ 0, "&apacir;" ], [ 0, {
    v: "&apE;",
    n: 824,
    o: "&napE;"
} ], [ 0, "&eplus;" ], [ 0, "&pluse;" ], [ 0, "&Esim;" ], [ 0, "&Colone;" ], [ 0, "&Equal;" ], [ 1, "&ddotseq;" ], [ 0, "&equivDD;" ], [ 0, "&ltcir;" ], [ 0, "&gtcir;" ], [ 0, "&ltquest;" ], [ 0, "&gtquest;" ], [ 0, {
    v: "&leqslant;",
    n: 824,
    o: "&nleqslant;"
} ], [ 0, {
    v: "&geqslant;",
    n: 824,
    o: "&ngeqslant;"
} ], [ 0, "&lesdot;" ], [ 0, "&gesdot;" ], [ 0, "&lesdoto;" ], [ 0, "&gesdoto;" ], [ 0, "&lesdotor;" ], [ 0, "&gesdotol;" ], [ 0, "&lap;" ], [ 0, "&gap;" ], [ 0, "&lne;" ], [ 0, "&gne;" ], [ 0, "&lnap;" ], [ 0, "&gnap;" ], [ 0, "&lEg;" ], [ 0, "&gEl;" ], [ 0, "&lsime;" ], [ 0, "&gsime;" ], [ 0, "&lsimg;" ], [ 0, "&gsiml;" ], [ 0, "&lgE;" ], [ 0, "&glE;" ], [ 0, "&lesges;" ], [ 0, "&gesles;" ], [ 0, "&els;" ], [ 0, "&egs;" ], [ 0, "&elsdot;" ], [ 0, "&egsdot;" ], [ 0, "&el;" ], [ 0, "&eg;" ], [ 2, "&siml;" ], [ 0, "&simg;" ], [ 0, "&simlE;" ], [ 0, "&simgE;" ], [ 0, {
    v: "&LessLess;",
    n: 824,
    o: "&NotNestedLessLess;"
} ], [ 0, {
    v: "&GreaterGreater;",
    n: 824,
    o: "&NotNestedGreaterGreater;"
} ], [ 1, "&glj;" ], [ 0, "&gla;" ], [ 0, "&ltcc;" ], [ 0, "&gtcc;" ], [ 0, "&lescc;" ], [ 0, "&gescc;" ], [ 0, "&smt;" ], [ 0, "&lat;" ], [ 0, {
    v: "&smte;",
    n: 65024,
    o: "&smtes;"
} ], [ 0, {
    v: "&late;",
    n: 65024,
    o: "&lates;"
} ], [ 0, "&bumpE;" ], [ 0, {
    v: "&PrecedesEqual;",
    n: 824,
    o: "&NotPrecedesEqual;"
} ], [ 0, {
    v: "&sce;",
    n: 824,
    o: "&NotSucceedsEqual;"
} ], [ 2, "&prE;" ], [ 0, "&scE;" ], [ 0, "&precneqq;" ], [ 0, "&scnE;" ], [ 0, "&prap;" ], [ 0, "&scap;" ], [ 0, "&precnapprox;" ], [ 0, "&scnap;" ], [ 0, "&Pr;" ], [ 0, "&Sc;" ], [ 0, "&subdot;" ], [ 0, "&supdot;" ], [ 0, "&subplus;" ], [ 0, "&supplus;" ], [ 0, "&submult;" ], [ 0, "&supmult;" ], [ 0, "&subedot;" ], [ 0, "&supedot;" ], [ 0, {
    v: "&subE;",
    n: 824,
    o: "&nsubE;"
} ], [ 0, {
    v: "&supE;",
    n: 824,
    o: "&nsupE;"
} ], [ 0, "&subsim;" ], [ 0, "&supsim;" ], [ 2, {
    v: "&subnE;",
    n: 65024,
    o: "&varsubsetneqq;"
} ], [ 0, {
    v: "&supnE;",
    n: 65024,
    o: "&varsupsetneqq;"
} ], [ 2, "&csub;" ], [ 0, "&csup;" ], [ 0, "&csube;" ], [ 0, "&csupe;" ], [ 0, "&subsup;" ], [ 0, "&supsub;" ], [ 0, "&subsub;" ], [ 0, "&supsup;" ], [ 0, "&suphsub;" ], [ 0, "&supdsub;" ], [ 0, "&forkv;" ], [ 0, "&topfork;" ], [ 0, "&mlcp;" ], [ 8, "&Dashv;" ], [ 1, "&Vdashl;" ], [ 0, "&Barv;" ], [ 0, "&vBar;" ], [ 0, "&vBarv;" ], [ 1, "&Vbar;" ], [ 0, "&Not;" ], [ 0, "&bNot;" ], [ 0, "&rnmid;" ], [ 0, "&cirmid;" ], [ 0, "&midcir;" ], [ 0, "&topcir;" ], [ 0, "&nhpar;" ], [ 0, "&parsim;" ], [ 9, {
    v: "&parsl;",
    n: 8421,
    o: "&nparsl;"
} ], [ 44343, {
    n: new Map(r([ [ 56476, "&Ascr;" ], [ 1, "&Cscr;" ], [ 0, "&Dscr;" ], [ 2, "&Gscr;" ], [ 2, "&Jscr;" ], [ 0, "&Kscr;" ], [ 2, "&Nscr;" ], [ 0, "&Oscr;" ], [ 0, "&Pscr;" ], [ 0, "&Qscr;" ], [ 1, "&Sscr;" ], [ 0, "&Tscr;" ], [ 0, "&Uscr;" ], [ 0, "&Vscr;" ], [ 0, "&Wscr;" ], [ 0, "&Xscr;" ], [ 0, "&Yscr;" ], [ 0, "&Zscr;" ], [ 0, "&ascr;" ], [ 0, "&bscr;" ], [ 0, "&cscr;" ], [ 0, "&dscr;" ], [ 1, "&fscr;" ], [ 1, "&hscr;" ], [ 0, "&iscr;" ], [ 0, "&jscr;" ], [ 0, "&kscr;" ], [ 0, "&lscr;" ], [ 0, "&mscr;" ], [ 0, "&nscr;" ], [ 1, "&pscr;" ], [ 0, "&qscr;" ], [ 0, "&rscr;" ], [ 0, "&sscr;" ], [ 0, "&tscr;" ], [ 0, "&uscr;" ], [ 0, "&vscr;" ], [ 0, "&wscr;" ], [ 0, "&xscr;" ], [ 0, "&yscr;" ], [ 0, "&zscr;" ], [ 52, "&Afr;" ], [ 0, "&Bfr;" ], [ 1, "&Dfr;" ], [ 0, "&Efr;" ], [ 0, "&Ffr;" ], [ 0, "&Gfr;" ], [ 2, "&Jfr;" ], [ 0, "&Kfr;" ], [ 0, "&Lfr;" ], [ 0, "&Mfr;" ], [ 0, "&Nfr;" ], [ 0, "&Ofr;" ], [ 0, "&Pfr;" ], [ 0, "&Qfr;" ], [ 1, "&Sfr;" ], [ 0, "&Tfr;" ], [ 0, "&Ufr;" ], [ 0, "&Vfr;" ], [ 0, "&Wfr;" ], [ 0, "&Xfr;" ], [ 0, "&Yfr;" ], [ 1, "&afr;" ], [ 0, "&bfr;" ], [ 0, "&cfr;" ], [ 0, "&dfr;" ], [ 0, "&efr;" ], [ 0, "&ffr;" ], [ 0, "&gfr;" ], [ 0, "&hfr;" ], [ 0, "&ifr;" ], [ 0, "&jfr;" ], [ 0, "&kfr;" ], [ 0, "&lfr;" ], [ 0, "&mfr;" ], [ 0, "&nfr;" ], [ 0, "&ofr;" ], [ 0, "&pfr;" ], [ 0, "&qfr;" ], [ 0, "&rfr;" ], [ 0, "&sfr;" ], [ 0, "&tfr;" ], [ 0, "&ufr;" ], [ 0, "&vfr;" ], [ 0, "&wfr;" ], [ 0, "&xfr;" ], [ 0, "&yfr;" ], [ 0, "&zfr;" ], [ 0, "&Aopf;" ], [ 0, "&Bopf;" ], [ 1, "&Dopf;" ], [ 0, "&Eopf;" ], [ 0, "&Fopf;" ], [ 0, "&Gopf;" ], [ 1, "&Iopf;" ], [ 0, "&Jopf;" ], [ 0, "&Kopf;" ], [ 0, "&Lopf;" ], [ 0, "&Mopf;" ], [ 1, "&Oopf;" ], [ 3, "&Sopf;" ], [ 0, "&Topf;" ], [ 0, "&Uopf;" ], [ 0, "&Vopf;" ], [ 0, "&Wopf;" ], [ 0, "&Xopf;" ], [ 0, "&Yopf;" ], [ 1, "&aopf;" ], [ 0, "&bopf;" ], [ 0, "&copf;" ], [ 0, "&dopf;" ], [ 0, "&eopf;" ], [ 0, "&fopf;" ], [ 0, "&gopf;" ], [ 0, "&hopf;" ], [ 0, "&iopf;" ], [ 0, "&jopf;" ], [ 0, "&kopf;" ], [ 0, "&lopf;" ], [ 0, "&mopf;" ], [ 0, "&nopf;" ], [ 0, "&oopf;" ], [ 0, "&popf;" ], [ 0, "&qopf;" ], [ 0, "&ropf;" ], [ 0, "&sopf;" ], [ 0, "&topf;" ], [ 0, "&uopf;" ], [ 0, "&vopf;" ], [ 0, "&wopf;" ], [ 0, "&xopf;" ], [ 0, "&yopf;" ], [ 0, "&zopf;" ] ]))
} ], [ 8906, "&fflig;" ], [ 0, "&filig;" ], [ 0, "&fllig;" ], [ 0, "&ffilig;" ], [ 0, "&ffllig;" ] ]));