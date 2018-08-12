### Instalando
````php
composer require marcosadantas/nfedata
````

Importante, caso não seja passado nenhum xml válido de nota fiscal, será lançado um exception `\InvalidArgument`;

#### Uso
````php
require 'vendor\autoload.php';

$xmlString = file_get_contents('PATH_TO_XML');

$nfeDocument = new \NfeData\NfeDocument($xmlString);

var_dump($nfeDocument->get('infAdic')->take('infAdFisco')->match('/[\d]{6,9}/'));
````


#### Metodos
````php
take() - Cria uma cópia de SepdData para poder transformar, pegar parte da informação, ou simplesmente extrai-la do contexto.
get() - Retorna o dado ou array diretamente associado.
````