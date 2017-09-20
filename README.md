# append-only-log

Objetivos:
Validar os logs dos projetos e descartar logs fraudulentos.

Tecnologias:

PHP 7+
Composer
Sqlite3

Algoritmo de para criar o hash:
hash('id' + 'prev_hash' + getDataRaw())

Função hash utilizada: sha256


todo:
Implementar chaves privadas e publicas como metodo de validação de identidade.
