Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var s = {}, t = {
        begin: /\$\{/,
        end: /\}/,
        contains: [ {
            begin: /:-/,
            contains: [ s ]
        } ]
    };
    Object.assign(s, {
        className: "variable",
        variants: [ {
            begin: /\$[\w\d#@][\w\d_]*/
        }, t ]
    });
    var a = {
        className: "subst",
        begin: /\$\(/,
        end: /\)/,
        contains: [ e.BACKSLASH_ESCAPE ]
    }, n = {
        className: "string",
        begin: /"/,
        end: /"/,
        contains: [ e.BACKSLASH_ESCAPE, s, a ]
    };
    a.contains.push(n);
    var i = {
        begin: /\$\(\(/,
        end: /\)\)/,
        contains: [ {
            begin: /\d+#[0-9a-f]+/,
            className: "number"
        }, e.NUMBER_MODE, s ]
    }, o = {
        className: "function",
        begin: /\w[\w\d_]*\s*\(\s*\)\s*\{/,
        returnBegin: !0,
        contains: [ e.inherit(e.TITLE_MODE, {
            begin: /\w[\w\d_]*/
        }) ],
        relevance: 0
    };
    return {
        name: "Bash",
        aliases: [ "sh", "zsh" ],
        lexemes: /\b-?[a-z\._]+\b/,
        keywords: {
            keyword: "if then else elif fi for while in do done case esac function",
            literal: "true false",
            built_in: "break cd continue eval exec exit export getopts hash pwd readonly return shift test times trap umask unset alias bind builtin caller command declare echo enable help let local logout mapfile printf read readarray source type typeset ulimit unalias set shopt autoload bg bindkey bye cap chdir clone comparguments compcall compctl compdescribe compfiles compgroups compquote comptags comptry compvalues dirs disable disown echotc echoti emulate fc fg float functions getcap getln history integer jobs kill limit log noglob popd print pushd pushln rehash sched setcap setopt stat suspend ttyctl unfunction unhash unlimit unsetopt vared wait whence where which zcompile zformat zftp zle zmodload zparseopts zprof zpty zregexparse zsocket zstyle ztcp",
            _: "-ne -eq -lt -gt -f -d -e -s -l -a"
        },
        contains: [ {
            className: "meta",
            begin: /^#![^\n]+sh\s*$/,
            relevance: 10
        }, o, i, e.HASH_COMMENT_MODE, n, {
            className: "",
            begin: /\\"/
        }, {
            className: "string",
            begin: /'/,
            end: /'/
        }, s ]
    };
};