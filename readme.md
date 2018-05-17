# page-assembler
A simple code to assemble html files

# Example

```
<-- template.html -->
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>Template</h1>
        @include ../components/navbar.html
    </body>
</html>
```

```
<-- navbar.html -->
<nav>
    <ul>
        <li><a href="#">Início</a></li>
        <li><a href="#">Contato</a></li>
        <li><a href="#">Portfolio</a></li>
    </ul>
</nav>
```

```
$PageAssembler = new PageAssembler;
$PageAssembler->build(__DIR__."/layouts/template.html", __DIR__."/newfile.html");
```

A file named "newfile.html" will be generated

```
<-- newfile.html -->
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h1>Template</h1>
        <nav>
            <ul>
                <li><a href="#">Início</a></li>
                <li><a href="#">Contato</a></li>
                <li><a href="#">Portfolio</a></li>
            </ul>
        </nav>
    </body>
</html>
```
