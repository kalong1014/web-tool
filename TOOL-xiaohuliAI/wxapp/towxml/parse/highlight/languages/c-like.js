Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    function t(e) {
        return "(?:" + e + ")?";
    }
    var n = "(decltype\\(auto\\)|" + t("[a-zA-Z_]\\w*::") + "[a-zA-Z_]\\w*" + t("<.*?>") + ")", r = {
        className: "keyword",
        begin: "\\b[a-z\\d_]*_t\\b"
    }, a = {
        className: "string",
        variants: [ {
            begin: '(u8?|U|L)?"',
            end: '"',
            illegal: "\\n",
            contains: [ e.BACKSLASH_ESCAPE ]
        }, {
            begin: "(u8?|U|L)?'(\\\\(x[0-9A-Fa-f]{2}|u[0-9A-Fa-f]{4,8}|[0-7]{3}|\\S)|.)",
            end: "'",
            illegal: "."
        }, {
            begin: /(?:u8?|U|L)?R"([^()\\ ]{0,16})\((?:.|\n)*?\)\1"/
        } ]
    }, s = {
        className: "number",
        variants: [ {
            begin: "\\b(0b[01']+)"
        }, {
            begin: "(-?)\\b([\\d']+(\\.[\\d']*)?|\\.[\\d']+)(u|U|l|L|ul|UL|f|F|b|B)"
        }, {
            begin: "(-?)(\\b0[xX][a-fA-F0-9']+|(\\b[\\d']+(\\.[\\d']*)?|\\.[\\d']+)([eE][-+]?[\\d']+)?)"
        } ],
        relevance: 0
    }, i = {
        className: "meta",
        begin: /#\s*[a-z]+\b/,
        end: /$/,
        keywords: {
            "meta-keyword": "if else elif endif define undef warning error line pragma _Pragma ifdef ifndef include"
        },
        contains: [ {
            begin: /\\\n/,
            relevance: 0
        }, e.inherit(a, {
            className: "meta-string"
        }), {
            className: "meta-string",
            begin: /<.*?>/,
            end: /$/,
            illegal: "\\n"
        }, e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE ]
    }, o = {
        className: "title",
        begin: t("[a-zA-Z_]\\w*::") + e.IDENT_RE,
        relevance: 0
    }, c = t("[a-zA-Z_]\\w*::") + e.IDENT_RE + "\\s*\\(", l = {
        keyword: "int float while private char char8_t char16_t char32_t catch import module export virtual operator sizeof dynamic_cast|10 typedef const_cast|10 const for static_cast|10 union namespace unsigned long volatile static protected bool template mutable if public friend do goto auto void enum else break extern using asm case typeid wchar_t short reinterpret_cast|10 default double register explicit signed typename try this switch continue inline delete alignas alignof constexpr consteval constinit decltype concept co_await co_return co_yield requires noexcept static_assert thread_local restrict final override atomic_bool atomic_char atomic_schar atomic_uchar atomic_short atomic_ushort atomic_int atomic_uint atomic_long atomic_ulong atomic_llong atomic_ullong new throw return and and_eq bitand bitor compl not not_eq or or_eq xor xor_eq",
        built_in: "std string wstring cin cout cerr clog stdin stdout stderr stringstream istringstream ostringstream auto_ptr deque list queue stack vector map set bitset multiset multimap unordered_set unordered_map unordered_multiset unordered_multimap array shared_ptr abort terminate abs acos asin atan2 atan calloc ceil cosh cos exit exp fabs floor fmod fprintf fputs free frexp fscanf future isalnum isalpha iscntrl isdigit isgraph islower isprint ispunct isspace isupper isxdigit tolower toupper labs ldexp log10 log malloc realloc memchr memcmp memcpy memset modf pow printf putchar puts scanf sinh sin snprintf sprintf sqrt sscanf strcat strchr strcmp strcpy strcspn strlen strncat strncmp strncpy strpbrk strrchr strspn strstr tanh tan vfprintf vprintf vsprintf endl initializer_list unique_ptr _Bool complex _Complex imaginary _Imaginary",
        literal: "true false nullptr NULL"
    }, d = [ r, e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, s, a ], _ = {
        variants: [ {
            begin: /=/,
            end: /;/
        }, {
            begin: /\(/,
            end: /\)/
        }, {
            beginKeywords: "new throw return else",
            end: /;/
        } ],
        keywords: l,
        contains: d.concat([ {
            begin: /\(/,
            end: /\)/,
            keywords: l,
            contains: d.concat([ "self" ]),
            relevance: 0
        } ]),
        relevance: 0
    }, u = {
        className: "function",
        begin: "(" + n + "[\\*&\\s]+)+" + c,
        returnBegin: !0,
        end: /[{;=]/,
        excludeEnd: !0,
        keywords: l,
        illegal: /[^\w\s\*&:<>]/,
        contains: [ {
            begin: "decltype\\(auto\\)",
            keywords: l,
            relevance: 0
        }, {
            begin: c,
            returnBegin: !0,
            contains: [ o ],
            relevance: 0
        }, {
            className: "params",
            begin: /\(/,
            end: /\)/,
            keywords: l,
            relevance: 0,
            contains: [ e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, a, s, r, {
                begin: /\(/,
                end: /\)/,
                keywords: l,
                relevance: 0,
                contains: [ "self", e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, a, s, r ]
            } ]
        }, r, e.C_LINE_COMMENT_MODE, e.C_BLOCK_COMMENT_MODE, i ]
    };
    return {
        aliases: [ "c", "cc", "h", "c++", "h++", "hpp", "hh", "hxx", "cxx" ],
        keywords: l,
        disableAutodetect: !0,
        illegal: "</",
        contains: [].concat(_, u, d, [ i, {
            begin: "\\b(deque|list|queue|stack|vector|map|set|bitset|multiset|multimap|unordered_map|unordered_set|unordered_multiset|unordered_multimap|array)\\s*<",
            end: ">",
            keywords: l,
            contains: [ "self", r ]
        }, {
            begin: e.IDENT_RE + "::",
            keywords: l
        }, {
            className: "class",
            beginKeywords: "class struct",
            end: /[{;:]/,
            contains: [ {
                begin: /</,
                end: />/,
                contains: [ "self" ]
            }, e.TITLE_MODE ]
        } ]),
        exports: {
            preprocessor: i,
            strings: a,
            keywords: l
        }
    };
};