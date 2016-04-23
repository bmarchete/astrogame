<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{

    /** 
	 * Todos os items devem ser colocados aqui
	 */
	public $posts = [
		
		[
			'title' => 'Astronomia como hobby',
			'short_description' => 'Temos hoje uma maravilhosa vista no céu noturno, dê uma saidinha lá fora e veja o planeta Júpiter a olho nu, logo abaixo da lua!',
			'slug' => 'astronomia-como-hobby',
			'content' => '<p>Quem nunca quis ter um hobby que quando te perguntam sobre o que você faz nos tempos vagos encher o peito e dizer que ama olhar as estrelas e sabe reconhecer fácil os objetos do céu noturno?</p>
<p>Todos deveriam ter astronomia como um hobby, não nada mais relaxante do que observar as estrelas e imaginar o que há nos lugares mais distantes.</p>
<p>Com a correria do dia a dia somados a luminosidade dos grandes centros, pouco nos atentamos para os astros que nos cercam, limitamos nossas observações apenas para grandes eventos, como eclipses e acabamos muitas vezes olhando apenas por um monitor ao vivo.</p>
<p>Começar esse hobby é simples, apenas olhe para cima durante a noite e comece apenas a observar o céu. Se conseguir um achar lugar alto, longe da luminosidade será melhor ainda!</p>
<p>Não é necessário um telescópio de primeiro momento, se tiver um binóculos empoeirado em casa pode auxiliar bastante nas primeiras observações do céu.</p>
<p>Após esse primeiro passo, chegou a hora de aprimorar seus conhecimentos e se aventurar mais e mais no cosmo. Para isso conclua todos os capítulos do Astrogame, após zerar o modo campanha você terá conhecimentos suficientes para entender muitas coisas do céu.</p>
<p>Se ainda não conhece o astrogame, clique no link abaixo e veja um pequeno trailer sobre o jogo desenvolvido por nós e clique em JOGAR para começar a aventura pelo cosmo!<p>',
            'user_id' => 1,
			'category' => 'astronomia',
            'img_url' => 'astronomia-hobby.jpg',
		],


        [
            'title' => 'Diário de um observador das estrelas',
            'short_description' => 'Didário de um observador das estrelas',
            'slug' => 'diario-estrelas-21-04-2016',
            'user_id' => 5,
            'category' => 'diario',
            'img_url' => 'VirtualAstro-Stargazing-Graphic-copy.jpg',
            'content' => '<p>Desde criança me contaram sobe os incríveis meteoros, me diziam que por muitas vezes foram tidos como sinais de deuses, ou até mesmo sinais apocalípticos e somente aos meus 16 anos pude entender o porquê disso.</p>
                         <p>O céu sempre manteve sua configuração estática, um grande quadro negro povoado de pequenos pontos brilhantes agrupados de forma caótica. Taís pontos iluminavam a imensidão escura como pequenas pontas de esperança nos piores momentos.</p>
<p>A madrugada do dia vinte um de abril, foi marcada pelo chuva de meteoros Líricas. O evento reuniu amigos, curiosos e até mesmo pessoas que não sabiam nada sobre astronomia, se juntaram para observar o maravilhoso show cósmico que estava acontecendo.</p>

<p>Incrível como a movimentação de poucas rochas no espaço puderam mobilizar tantos na terra. As novas pinceladas no céu coloriram não só o grande quadro noturno, como deram novas cores a vida de muitos na terra, e falo por experiência própria.</p>

<p>Nunca imaginei que observar o céu seria tão gratificante. Saber que o dia é belo pela imensidão azul e suas cores vivas sempre foi de conhecimento geral. Mas naquela noite, pude perceber como o céu noturno tem sua beleza também. Milhões de astros repousando sobre um manto preto, que dividem seu palco com a que sempre rouba a cena, a bela e brilhante lua, possuem sua beleza inigualável também.</p>

<p>Rochas cruzando o céu, como longas pinceladas em uma tela, estrelas e astros fixos como pontos previamente alinhados, compunham o quadro daquela noite. Tal quadro não ficaria exposto em um museu comum, seu valor era alto de mais para isso, mas ficaria eternamente guardado nas memórias de pessoas que assim como eu, assistiram aquele belíssimo balé cósmico.</p>

<p>Aglomerados de poeira, energia e gases, emitem suas partículas cores através do universo, mas de onde estava, eram todos de mesma beleza, uns maiores que os outros, mas isso não tirava a atenção dos pequeninos. Coisas mais antigas que nos e certamente com um papel de maior destaque que o nosso na grande dança cósmica, poderiam ser igualados a simples pontos de luz em uma infinidade negra.  </p>
<p>Quanto tempo até os homens perceberem que assim como as estrelas, podemos ser todos iguais ? Que por muitas vezes, nos enxergamos tão diferentes uns dos outros, mas que isso se dá pelo ponto de vista tão pequeno que nos temos ? Quanto tempo levaria para que nos estivéssemos  no ponto correto para que pudéssemos enxergar que no fim, somos todos iguais ? Talvez eu não viesse a ter essa resposta durante minha curta vida, mas sei que um dia, talvez a humanidade pudesse ser representada em um belo quadro assim como o daquela noite.</p>

<p>Diário de um observador das estrelas – 21/04/2016</p>',
        ],
	];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach($this->posts as $post){
    		if(DB::table('posts')->where('title', $post['title'])->get() == null){
    			DB::table('posts')->insert($post);
    			echo '[ INFO ] Post: ' . e($post['title']) . " adicionado. \n";
    		}
    	}
    }
}
