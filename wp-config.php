<?php
/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'criare_davo');

/** Usuário do banco de dados MySQL */
if(!$_SERVER['SERVER_ADDR'] == '::1'){
    define('DB_USER', 'criare_davo');
}else{
    define('DB_USER', 'root');
}

/** Senha do banco de dados MySQL */
if(!$_SERVER['SERVER_ADDR'] == '::1'){
    define('DB_PASSWORD', 'tCn9w8vH');
}else{
    define('DB_PASSWORD', ''); 
}

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'VKp8(5:+^P<*S0nerS_=B^D1Z9XsuU6x@pA2.UF{JnK`lmMvVO}x*iIdPRrHbJtk');
define('SECURE_AUTH_KEY',  'v.)`B$;#l-#G=LPiLuQ8oS.<.DQ]]uR8iwr.j5D;485fMH=Q m-u9oFbEq$fp41a');
define('LOGGED_IN_KEY',    'gXE*s}!A3|0W(e~s5&jd4qs#P(fdzsXg`2w<QU4BE4Un!T j(|=kxu,8XOIzl:_I');
define('NONCE_KEY',        ']Ak`Us0@%)=v3~g$-kiAsZj:&oR@Gs5V`Py&SW 573?Ce7{tLPY_99PVbRLJc6E0');
define('AUTH_SALT',        '%0[l]Yz^)jx$kGvmb$,-uy#:F&}RnyNG^=&mWKVA09c=Cbu-[|]nBtyD5;V7h-W6');
define('SECURE_AUTH_SALT', ' 5OJJ17+ernJEKYpEC?//jHWfRamA.2(r&<[#)V.V$>1[gmAj{^li_7oN&_>42)1');
define('LOGGED_IN_SALT',   '=ASN~8x#=d(F0{)*aZ{L.9[,<M;oH=`H$TfbV4~gN^V</VV>_;Bu)aZJ(;f;v=NA');
define('NONCE_SALT',       'T~lVD$$Ngk^#k_57SEs`G8Ss0Z+x6c{r8e!^:D!CN[I+c<(?ky^>:N$0-k7G]|=~');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * O idioma localizado do WordPress é o inglês por padrão.
 *
 * Altere esta definição para localizar o WordPress. Um arquivo MO correspondente ao
 * idioma escolhido deve ser instalado em wp-content/languages. Por exemplo, instale
 * pt_BR.mo em wp-content/languages e altere WPLANG para 'pt_BR' para habilitar o suporte
 * ao português do Brasil.
 */
define('WPLANG', 'pt_BR');

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
