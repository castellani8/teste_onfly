<h1>Despesa cadastrada</h1>

Boa tarde Dr(a). {{$despesa->user->name}}, segue os detalhes:

<p>Código de identificação: {{ $despesa->id }}</p>
<p>Descrição: {{ $despesa->description }}</p>
<p>Valor: R$ {{ $despesa->value }}</p>
<p>Registrado em: {{ $despesa->created_at }}</p>