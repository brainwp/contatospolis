<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __('URL do Bot&atilde;o', 'textdomain'),
			'desc' => __('Adicionar o link do bot&atilde;o - ex.: http://wordpress.org', 'textdomain')
		),
		'style' => array(
			'type' => 'select',
			'label' => __('Estilo do Bot&atilde;o', 'textdomain'),
			'desc' => __('Selecionar a cor do bot&atilde;o', 'textdomain'),
			'options' => array(
				'grey' => 'Cinza',
				'black' => 'Preto',
				'green' => 'Verde',
				'light-blue' => 'Azul Claro',
				'blue' => 'Azul',
				'red' => 'Vermelho',
				'orange' => 'Laranja',
				'purple' => 'Roxo'
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __('Tamanho do Bot&atilde;o', 'textdomain'),
			'desc' => __('Selecione o tamanho', 'textdomain'),
			'options' => array(
				'small' => 'Pequeno',
				'medium' => 'M&eacute;dio',
				'large' => 'Grande'
			)
		),
		'type' => array(
			'type' => 'select',
			'label' => __('Tipo de Bot&atilde;o', 'textdomain'),
			'desc' => __('Selecione o tipo', 'textdomain'),
			'options' => array(
				'round' => 'Arredondado',
				'square' => 'Quadrado'
			)
		),
		'target' => array(
			'type' => 'select',
			'label' => __('Target do Bot&atilde;o', 'textdomain'),
			'desc' => __('_self = abre na mesma janela. _blank = abre em uma nova janela', 'textdomain'),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'content' => array(
			'std' => 'Texto do Bot&atilde;o',
			'type' => 'text',
			'label' => __('Leia Mais', 'textdomain'),
			'desc' => __('Adicione o texto que quer ver no bot&atilde;o', 'textdomain'),
		)
	),
	'shortcode' => '[zilla_button url="{{url}}" style="{{style}}" size="{{size}}" type="{{type}}" target="{{target}}"] {{content}} [/zilla_button]',
	'popup_title' => __('Inserir Shortcode de Bot&atilde;o', 'textdomain')
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(
		'style' => array(
			'type' => 'select',
			'label' => __('Estilo do Alerta', 'textdomain'),
			'desc' => __('Escolha a cor do alerta', 'textdomain'),
			'options' => array(
				'white' => 'Branco',
				'grey' => 'Cinza',
				'red' => 'Vermelho',
				'yellow' => 'Amarelo',
				'green' => 'Verde'
			)
		),
		'content' => array(
			'std' => 'Alerta!',
			'type' => 'textarea',
			'label' => __('Texto do Alerta', 'textdomain'),
			'desc' => __('Adicione o texto do alerta', 'textdomain'),
		)
		
	),
	'shortcode' => '[zilla_alert style="{{style}}"] {{content}} [/zilla_alert]',
	'popup_title' => __('Inserir Shortcode de Alerta', 'textdomain')
);

/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['toggle'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'type' => 'text',
			'label' => __('T&iacute;tulo do Toggle', 'textdomain'),
			'desc' => __('Adicione o t&iacute;tulo do Togle', 'textdomain'),
			'std' => 'Titulo'
		),
		'content' => array(
			'std' => 'Conteudo',
			'type' => 'textarea',
			'label' => __('Conteudo do Toggle', 'textdomain'),
			'desc' => __('Adicionar o conte&uacute;do do Toogle. Aceita HTML', 'textdomain'),
		),
		'state' => array(
			'type' => 'select',
			'label' => __('Formato do Toggle', 'textdomain'),
			'desc' => __('Selecione o formato do Toogle ao carregar a p&aacute;gina', 'textdomain'),
			'options' => array(
				'open' => 'Aberto',
				'closed' => 'Fechado'
			)
		),
		
	),
	'shortcode' => '[zilla_toggle title="{{title}}" state="{{state}}"] {{content}} [/zilla_toggle]',
	'popup_title' => __('Inserir Shortcode de Toogle', 'textdomain')
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['tabs'] = array(
    'params' => array(),
    'no_preview' => true,
    'shortcode' => '[zilla_tabs] {{child_shortcode}}  [/zilla_tabs]',
    'popup_title' => __('Inserir Shortcode de Abas', 'textdomain'),
    
    'child_shortcode' => array(
        'params' => array(
            'title' => array(
                'std' => 'Titulo',
                'type' => 'text',
                'label' => __('T&iacute;tulo da Aba', 'textdomain'),
                'desc' => __('Inserir t&iacute;tulo da aba', 'textdomain'),
            ),
            'content' => array(
                'std' => 'Conteudo da aba',
                'type' => 'textarea',
                'label' => __('Conte&uacute;do da Aba', 'textdomain'),
                'desc' => __('Adicione o conte&uacute;do da Aba', 'textdomain')
            )
        ),
        'shortcode' => '[zilla_tab title="{{title}}"] {{content}} [/zilla_tab]',
        'clone_button' => __('Adicionar Aba', 'textdomain')
    )
);

/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$zilla_shortcodes['columns'] = array(
	'params' => array(),
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __('Insert Shortcode de Colunas', 'textdomain'),
	'no_preview' => true,
	
	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __('Tipo de Coluna', 'textdomain'),
				'desc' => __('Selecione a largura da Coluna', 'textdomain'),
				'options' => array(
					'zilla_one_third' => 'Um Ter&ccedil;o',
					'zilla_one_third_last' => '&Uacute;ltimo Ter&ccedil;o',
					'zilla_two_third' => 'Dois Ter&ccedil;os',
					'zilla_two_third_last' => '&Uacute;ltimo Dois Ter&ccedil;os',
					'zilla_one_half' => 'Metade',
					'zilla_one_half_last' => '&Uacute;ltima Metade',
					'zilla_one_fourth' => 'Um Quarto',
					'zilla_one_fourth_last' => '&Uacute;ltimo Quarto',
					'zilla_three_fourth' => 'Tr&ecirc;s Ter&ccedil;os',
					'zilla_three_fourth_last' => '&Uacute;ltimo Tres Ter&ccedil;os',
					'zilla_one_fifth' => 'Um Quinto',
					'zilla_one_fifth_last' => '&Uacute;ltimo Um Quinto',
					'zilla_two_fifth' => 'Dois Quintos',
					'zilla_two_fifth_last' => '&Uacute;ltimo Dois Quintos',
					'zilla_three_fifth' => 'Tr&ecirc;s Quintos',
					'zilla_three_fifth_last' => '&Uacute;ltimo Tres Quintos',
					'zilla_four_fifth' => 'Quatro Quintos',
					'zilla_four_fifth_last' => '&Uacute;ltimo Quatro Quintos',
					'zilla_one_sixth' => 'Um Sexto',
					'zilla_one_sixth_last' => '&Uacute;ltimo Um Sexto',
					'zilla_five_sixth' => 'Cinco Sextos',
					'zilla_five_sixth_last' => '&Uacute;ltimo Cinco Sextos'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __('Conte&uacute;do da Coluna', 'textdomain'),
				'desc' => __('Adicione conte&uacute;do &agrave; coluna', 'textdomain'),
			)
		),
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'clone_button' => __('Adicionar Coluna', 'textdomain')
	)
);

?>