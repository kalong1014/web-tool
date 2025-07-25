Object.defineProperty(exports, "__esModule", {
    value: !0
}), exports.default = function(e) {
    var r = {
        begin: "\\$+[a-zA-Z_-ÿ][a-zA-Z0-9_-ÿ]*"
    }, t = {
        className: "meta",
        variants: [ {
            begin: /<\?php/,
            relevance: 10
        }, {
            begin: /<\?[=]?/
        }, {
            begin: /\?>/
        } ]
    }, a = {
        className: "string",
        contains: [ e.BACKSLASH_ESCAPE, t ],
        variants: [ {
            begin: 'b"',
            end: '"'
        }, {
            begin: "b'",
            end: "'"
        }, e.inherit(e.APOS_STRING_MODE, {
            illegal: null
        }), e.inherit(e.QUOTE_STRING_MODE, {
            illegal: null
        }) ]
    }, i = {
        variants: [ e.BINARY_NUMBER_MODE, e.C_NUMBER_MODE ]
    }, n = {
        keyword: "__CLASS__ __DIR__ __FILE__ __FUNCTION__ __LINE__ __METHOD__ __NAMESPACE__ __TRAIT__ die echo exit include include_once print require require_once array abstract and as binary bool boolean break callable case catch class clone const continue declare default do double else elseif empty enddeclare endfor endforeach endif endswitch endwhile eval extends final finally float for foreach from global goto if implements instanceof insteadof int integer interface isset iterable list new object or private protected public real return string switch throw trait try unset use var void while xor yield",
        literal: "false null true",
        built_in: "Error|0 AppendIterator ArgumentCountError ArithmeticError ArrayIterator ArrayObject AssertionError BadFunctionCallException BadMethodCallException CachingIterator CallbackFilterIterator CompileError Countable DirectoryIterator DivisionByZeroError DomainException EmptyIterator ErrorException Exception FilesystemIterator FilterIterator GlobIterator InfiniteIterator InvalidArgumentException IteratorIterator LengthException LimitIterator LogicException MultipleIterator NoRewindIterator OutOfBoundsException OutOfRangeException OuterIterator OverflowException ParentIterator ParseError RangeException RecursiveArrayIterator RecursiveCachingIterator RecursiveCallbackFilterIterator RecursiveDirectoryIterator RecursiveFilterIterator RecursiveIterator RecursiveIteratorIterator RecursiveRegexIterator RecursiveTreeIterator RegexIterator RuntimeException SeekableIterator SplDoublyLinkedList SplFileInfo SplFileObject SplFixedArray SplHeap SplMaxHeap SplMinHeap SplObjectStorage SplObserver SplObserver SplPriorityQueue SplQueue SplStack SplSubject SplSubject SplTempFileObject TypeError UnderflowException UnexpectedValueException ArrayAccess Closure Generator Iterator IteratorAggregate Serializable Throwable Traversable WeakReference Directory __PHP_Incomplete_Class parent php_user_filter self static stdClass"
    };
    return {
        aliases: [ "php", "php3", "php4", "php5", "php6", "php7" ],
        case_insensitive: !0,
        keywords: n,
        contains: [ e.HASH_COMMENT_MODE, e.COMMENT("//", "$", {
            contains: [ t ]
        }), e.COMMENT("/\\*", "\\*/", {
            contains: [ {
                className: "doctag",
                begin: "@[A-Za-z]+"
            } ]
        }), e.COMMENT("__halt_compiler.+?;", !1, {
            endsWithParent: !0,
            keywords: "__halt_compiler",
            lexemes: e.UNDERSCORE_IDENT_RE
        }), {
            className: "string",
            begin: /<<<['"]?\w+['"]?$/,
            end: /^\w+;?$/,
            contains: [ e.BACKSLASH_ESCAPE, {
                className: "subst",
                variants: [ {
                    begin: /\$\w+/
                }, {
                    begin: /\{\$/,
                    end: /\}/
                } ]
            } ]
        }, t, {
            className: "keyword",
            begin: /\$this\b/
        }, r, {
            begin: /(::|->)+[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*/
        }, {
            className: "function",
            beginKeywords: "fn function",
            end: /[;{]/,
            excludeEnd: !0,
            illegal: "[$%\\[]",
            contains: [ e.UNDERSCORE_TITLE_MODE, {
                className: "params",
                begin: "\\(",
                end: "\\)",
                excludeBegin: !0,
                excludeEnd: !0,
                keywords: n,
                contains: [ "self", r, e.C_BLOCK_COMMENT_MODE, a, i ]
            } ]
        }, {
            className: "class",
            beginKeywords: "class interface",
            end: "{",
            excludeEnd: !0,
            illegal: /[:\(\$"]/,
            contains: [ {
                beginKeywords: "extends implements"
            }, e.UNDERSCORE_TITLE_MODE ]
        }, {
            beginKeywords: "namespace",
            end: ";",
            illegal: /[\.']/,
            contains: [ e.UNDERSCORE_TITLE_MODE ]
        }, {
            beginKeywords: "use",
            end: ";",
            contains: [ e.UNDERSCORE_TITLE_MODE ]
        }, {
            begin: "=>"
        }, a, i ]
    };
};