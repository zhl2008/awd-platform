// +build OMIT

package main

// fake stuff
type char uint8;

// const char TESTSTRING[] = "(defn foo (add 'a 'b))\n";

type Atom struct {
        string  *[100]char;
        integer int;
        next    *Slist;  /* in hash bucket */
}

type List struct {
        car     *Slist;
        cdr     *Slist;
}

type Slist struct {
        isatom          bool;
        isstring        bool;
        //union {
        atom    Atom;
        list    List;
        //} u;

        Free method();
        Print method();
        PrintOne method(doparen bool);
        String method(*char <-);
        Integer method(int <-);
        Car method(*Slist <-);
        Cdr method(*Slist <-);
}

method (this *Slist) Car(*Slist <-) {
        return this.list.car;
}

method (this *Slist) Cdr(*Slist <-) {
        return this.list.cdr;
}

method (this *Slist) String(*[100]char <-) {
        return this.atom.string;
}

method (this *Slist) Integer(int <-) {
        return this.atom.integer;
}

function OpenFile();
function Parse(*Slist <-);

//Slist* atom(char *s, int i);

var token int;
var peekc int = -1;
var lineno int32 = 1;

var input [100*1000]char;
var inputindex int = 0;
var tokenbuf [100]char;

var EOF int = -1;  // BUG should be const

function main(int32 <-) {
        var list *Slist;

        OpenFile();
        for ;; {
                list = Parse();
                if list == nil {
                        break;
                }
                list.Print();
                list.Free();
                break;
        }

        return 0;
}

method (slist *Slist) Free(<-) {
        if slist == nil {
                return;
        }
        if slist.isatom {
//              free(slist.String());
        } else {
                slist.Car().Free();
                slist.Cdr().Free();
        }
//      free(slist);
}

method (slist *Slist) PrintOne(<- doparen bool) {
        if slist == nil {
                return;
        }
        if slist.isatom {
                if slist.isstring {
                        print(slist.String());
                } else {
                        print(slist.Integer());
                }
        } else {
                if doparen {
                        print("(");
                }
                slist.Car().PrintOne(true);
                if slist.Cdr() != nil {
                        print(" ");
                        slist.Cdr().PrintOne(false);
                }
                if doparen {
                        print(")");
                }
        }
}

method (slist *Slist) Print() {
        slist.PrintOne(true);
        print "\n";
}

function Get(int <-) {
        var c int;

        if peekc >= 0 {
                c = peekc;
                peekc = -1;
        } else {
                c = convert(int, input[inputindex]);
                inputindex = inputindex + 1; // BUG should be incr one expr
                if c == '\n' {
                        lineno = lineno + 1;
                }
                if c == '\0' {
                        inputindex = inputindex - 1;
                        c = EOF;
                }
        }
        return c;
}

function WhiteSpace(bool <- c int) {
        return c == ' ' || c == '\t' || c == '\r' || c == '\n';
}

function NextToken() {
        var i, c int;
        var backslash bool;

        tokenbuf[0] = '\0';     // clear previous token
        c = Get();
        while WhiteSpace(c)  {
                c = Get();
        }
        switch c {
                case EOF:
                        token = EOF;
                case '(':
                case ')':
                        token = c;
                        break;
                case:
                        for i = 0; i < 100 - 1; {  // sizeof tokenbuf - 1
                                tokenbuf[i] = convert(char, c);
                                i = i + 1;
                                c = Get();
                                if c == EOF {
                                        break;
                                }
                                if WhiteSpace(c) || c == ')' {
                                        peekc = c;
                                        break;
                                }
                        }
                        if i >= 100 - 1 {  // sizeof tokenbuf - 1
                                panic "atom too long\n";
                        }
                        tokenbuf[i] = '\0';
                        if '0' <= tokenbuf[0] && tokenbuf[0] <= '9' {
                                token = '0';
                        } else {
                                token = 'A';
                        }
        }
}

function Expect(<- c int) {
        if token != c {
                print "parse error: expected ", c, "\n";
                panic "parse";
        }
        NextToken();
}

// Parse a non-parenthesized list up to a closing paren or EOF
function ParseList(*Slist <-) {
        var slist, retval *Slist;

        slist = new(Slist);
        slist.list.car = nil;
        slist.list.cdr = nil;
        slist.isatom = false;
        slist.isstring = false;

        retval = slist;
        for ;; {
                slist.list.car = Parse();
                if token == ')' {       // empty cdr
                        break;
                }
                if token == EOF {       // empty cdr  BUG SHOULD USE ||
                        break;
                }
                slist.list.cdr = new(Slist);
                slist = slist.list.cdr;
        }
        return retval;
}

function atom(*Slist <- i int) {  // BUG: uses tokenbuf; should take argument
        var h, length int;
        var slist, tail *Slist;
        
        slist = new(Slist);
        if token == '0' {
                slist.atom.integer = i;
                slist.isstring = false;
        } else {
                slist.atom.string = new([100]char);
                var i int;
                for i = 0; ; i = i + 1 {
                        (*slist.atom.string)[i] = tokenbuf[i];
                        if tokenbuf[i] == '\0' {
                                break;
                        }
                }
                //slist.atom.string = "hello"; // BUG! s; //= strdup(s);
                slist.isstring = true;
        }
        slist.isatom = true;
        return slist;
}

function atoi(int <-) {  // BUG: uses tokenbuf; should take argument
        var v int = 0;
        for i := 0; '0' <= tokenbuf[i] && tokenbuf[i] <= '9'; i = i + 1 {
                v = 10 * v + convert(int, tokenbuf[i] - '0');
        }
        return v;
}

function Parse(*Slist <-) {
        var slist *Slist;
        
        if token == EOF || token == ')' {
                return nil;
        }
        if token == '(' {
                NextToken();
                slist = ParseList();
                Expect(')');
                return slist;
        } else {
                // Atom
                switch token {
                        case EOF:
                                return nil;
                        case '0':
                                slist = atom(atoi());
                        case '"':
                        case 'A':
                                slist = atom(0);
                        case:
                                slist = nil;
                                print "unknown token"; //, token, tokenbuf;
                }
                NextToken();
                return slist;
        }
        return nil;
}

function OpenFile() {
        //strcpy(input, TESTSTRING);
        //inputindex = 0;
        // (defn foo (add 12 34))\n
        inputindex = 0;
        peekc = -1;  // BUG
        EOF = -1;  // BUG
        i := 0;
        input[i] = '('; i = i + 1;
        input[i] = 'd'; i = i + 1;
        input[i] = 'e'; i = i + 1;
        input[i] = 'f'; i = i + 1;
        input[i] = 'n'; i = i + 1;
        input[i] = ' '; i = i + 1;
        input[i] = 'f'; i = i + 1;
        input[i] = 'o'; i = i + 1;
        input[i] = 'o'; i = i + 1;
        input[i] = ' '; i = i + 1;
        input[i] = '('; i = i + 1;
        input[i] = 'a'; i = i + 1;
        input[i] = 'd'; i = i + 1;
        input[i] = 'd'; i = i + 1;
        input[i] = ' '; i = i + 1;
        input[i] = '1'; i = i + 1;
        input[i] = '2'; i = i + 1;
        input[i] = ' '; i = i + 1;
        input[i] = '3'; i = i + 1;
        input[i] = '4'; i = i + 1;
        input[i] = ')'; i = i + 1;
        input[i] = ')'; i = i + 1;
        input[i] = '\n'; i = i + 1;
        NextToken();
}
