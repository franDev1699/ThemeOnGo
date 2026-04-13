<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ThemeOnGo_Services_Filter_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'themeongo_services_filter';
	}

	public function get_title() {
		return esc_html__( 'ThemeOnGo Services Filter', 'themeongo' );
	}

	public function get_icon() {
		return 'eicon-filter';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Filters', 'themeongo' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'filters_bg_color',
			[
				'label' => esc_html__( 'Filters Background Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
			]
		);

		$repeater_filters = new \Elementor\Repeater();

		$repeater_filters->add_control(
			'filter_id',
			[
				'label' => esc_html__( 'Filter ID (no spaces)', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'todos',
				'description' => 'Used to link cards to this filter (e.g. "rostro"). Use "todos" to show all cards.'
			]
		);

		$repeater_filters->add_control(
			'filter_label',
			[
				'label' => esc_html__( 'Filter Label', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Todos',
			]
		);

		$this->add_control(
			'filters',
			[
				'label' => esc_html__( 'Filter Tabs', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater_filters->get_controls(),
				'default' => [
					[ 'filter_id' => 'todos', 'filter_label' => 'Todos' ],
					[ 'filter_id' => 'rostro', 'filter_label' => 'Rostro' ],
					[ 'filter_id' => 'corporal', 'filter_label' => 'Corporal' ],
				],
				'title_field' => '{{{ filter_label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'cards_section',
			[
				'label' => esc_html__( 'Cards', 'themeongo' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
			'cards_area_bg_color',
			[
				'label' => esc_html__( 'Cards Area Background Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#EDE3D9', // Nude background
			]
		);

		$repeater_cards = new \Elementor\Repeater();

		$repeater_cards->add_control(
			'card_category',
			[
				'label' => esc_html__( 'Category ID', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'rostro',
				'description' => 'Must match a Filter ID above.'
			]
		);

		$repeater_cards->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Top Background Color', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#8FAFA2',
			]
		);

		$repeater_cards->add_control(
			'top_icon',
			[
				'label' => esc_html__( 'Top Icon (Class)', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'fa-solid fa-leaf',
				'description' => 'Enter FontAwesome class (e.g. fa-solid fa-leaf, fa-solid fa-droplet)'
			]
		);

		$repeater_cards->add_control(
			'pill_text',
			[
				'label' => esc_html__( 'Pill Text', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Lorem Ipsum',
			]
		);

		$repeater_cards->add_control(
			'card_title',
			[
				'label' => esc_html__( 'Title', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Lorem Ipsum Dolor',
			]
		);

		$repeater_cards->add_control(
			'card_desc',
			[
				'label' => esc_html__( 'Description', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor...',
			]
		);

		$repeater_cards->add_control(
			'card_features',
			[
				'label' => esc_html__( 'Features (HTML List)', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => '<ul><li>Lorem ipsum dolor</li><li>Sit amet consectetur</li></ul>',
			]
		);

		$repeater_cards->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Lorem Ipsum',
			]
		);

		$repeater_cards->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [ 'url' => '#' ],
			]
		);

		$this->add_control(
			'cards',
			[
				'label' => esc_html__( 'Service Cards', 'themeongo' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater_cards->get_controls(),
				'default' => [
					[
						'card_category' => 'rostro',
						'card_title' => 'Lorem Ipsum Dolor',
					],
				],
				'title_field' => '{{{ card_title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		
		echo '<div class="tgo-services-filter-wrapper">';
		
		// Filters Bar
		$filters_bg = !empty($settings['filters_bg_color']) ? esc_attr($settings['filters_bg_color']) : '#ffffff';
		echo '<div class="tgo-filters-bar py-5" style="background-color: ' . $filters_bg . ';">';
		echo '<div class="container">';
		if ( ! empty( $settings['filters'] ) ) {
			echo '<div class="d-flex justify-content-center flex-wrap gap-2">';
			$first = true;
			foreach ( $settings['filters'] as $filter ) {
				$active_class = $first ? 'active' : '';
				$first = false;
				echo '<button class="btn btn-filter rounded-pill px-4 py-2 text-dark border-0 fs-6 fw-medium tgo-filter-btn ' . esc_attr($active_class) . '" data-filter="' . esc_attr($filter['filter_id']) . '">' . esc_html($filter['filter_label']) . '</button>';
			}
			echo '</div>';
		}
		echo '</div>'; // end container
		echo '</div>'; // end filters bar

		// Cards Grid
		$cards_bg = !empty($settings['cards_area_bg_color']) ? esc_attr($settings['cards_area_bg_color']) : '';
		if(empty($cards_bg) && isset($settings['__globals__']['cards_area_bg_color'])) {
			$global_key = str_replace('globals/colors?id=', '', $settings['__globals__']['cards_area_bg_color']);
			$cards_bg = 'var(--e-global-color-' . $global_key . ')';
		}
		if(empty($cards_bg)) $cards_bg = '#EDE3D9';

		echo '<div class="tgo-cards-area py-5" style="background-color: ' . $cards_bg . ';">';
		echo '<div class="container">';
		if ( ! empty( $settings['cards'] ) ) {
			echo '<div class="row g-4 tgo-cards-grid justify-content-center">';
			foreach ( $settings['cards'] as $card ) {
				$category = esc_attr( $card['card_category'] );
				echo '<div class="col-md-6 col-lg-4 tgo-card-item" data-category="' . $category . '">';
				echo '<div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden service-filter-card">';
				
				// Top Background
				$bg_color = !empty($card['bg_color']) ? esc_attr($card['bg_color']) : '';
				if(empty($bg_color) && isset($card['__globals__']['bg_color'])) {
					$global_key = str_replace('globals/colors?id=', '', $card['__globals__']['bg_color']);
					$bg_color = 'var(--e-global-color-' . $global_key . ')';
				}
				if(empty($bg_color)) $bg_color = '#8FAFA2'; // Default

				echo '<div class="service-card-top d-flex align-items-center justify-content-center" style="background-color: ' . $bg_color . '; height: 180px;">';
				
				$icon_class = !empty($card['top_icon']) ? $card['top_icon'] : 'fa-solid fa-leaf';
				
				echo '<div class="text-white" style="font-size: 3.5rem;">';
				echo '<i class="' . esc_attr($icon_class) . '"></i>';
				echo '</div>';
				
				echo '</div>';

				// Body
				echo '<div class="card-body p-4 d-flex flex-column">';
				
				// Pill
				if(!empty($card['pill_text'])) {
					echo '<div class="d-flex align-items-center mb-3">';
					echo '<div class="bg-nude rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px; color: #506F67;">';
					echo '<div style="font-size: 0.9rem;">';
					echo '<i class="' . esc_attr($icon_class) . ' fa-sm"></i>';
					echo '</div>';
					echo '</div>';
					echo '<span class="badge rounded-pill bg-light text-dark border px-3 py-2 text-muted fw-medium">' . esc_html($card['pill_text']) . '</span>';
					echo '</div>';
				}

				echo '<h4 class="card-title fw-bold mb-3" style="color: #2A2C2B;">' . esc_html($card['card_title']) . '</h4>';
				echo '<p class="card-text text-muted small mb-4">' . wp_kses_post($card['card_desc']) . '</p>';
				
				// Features
				if(!empty($card['card_features'])) {
					echo '<div class="service-features mb-4 small text-muted flex-grow-1">';
					echo wp_kses_post($card['card_features']);
					echo '</div>';
				} else {
                    echo '<div class="flex-grow-1"></div>';
                }

				// Button
				if(!empty($card['btn_text'])) {
					$url = $card['btn_link']['url'] ?? '#';
					echo '<a href="' . esc_url($url) . '" class="btn btn-dark-green w-100 rounded-pill py-3 mt-auto fw-bold">' . esc_html($card['btn_text']) . '</a>';
				}

				echo '</div>'; // end card-body
				echo '</div>'; // end card
				echo '</div>'; // end col
			}
			echo '</div>'; // end row
		}
		echo '</div>'; // end container
		echo '</div>'; // end cards area
		
		echo '</div>'; // end wrapper

		// JS for filtering
		?>
		<script>
		document.addEventListener("DOMContentLoaded", function() {
			var wrappers = document.querySelectorAll('.tgo-services-filter-wrapper');
			
			wrappers.forEach(function(wrapper) {
				var filterBtns = wrapper.querySelectorAll('.tgo-filter-btn');
				var cards = wrapper.querySelectorAll('.tgo-card-item');

				filterBtns.forEach(function(btn) {
					btn.addEventListener('click', function() {
						// Remove active class from all
						filterBtns.forEach(b => b.classList.remove('active', 'bg-dark-green', 'text-white'));
						filterBtns.forEach(b => b.classList.add('text-dark'));
						
						// Add active to clicked
						this.classList.add('active', 'bg-dark-green', 'text-white');
						this.classList.remove('text-dark');

						var filter = this.getAttribute('data-filter');

						cards.forEach(function(card) {
							if(filter === 'todos' || card.getAttribute('data-category') === filter) {
								card.style.display = 'block';
								setTimeout(() => { card.style.opacity = '1'; card.style.transform = 'scale(1)'; }, 50);
							} else {
								card.style.opacity = '0';
								card.style.transform = 'scale(0.9)';
								setTimeout(() => { card.style.display = 'none'; }, 300);
							}
						});
					});
				});

				// Trigger click on first button to set initial state
				if(filterBtns.length > 0) {
					filterBtns[0].click();
				}
			});
		});
		</script>
		<?php
	}
}
