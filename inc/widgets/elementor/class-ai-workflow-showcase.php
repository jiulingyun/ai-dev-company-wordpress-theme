<?php
/**
 * Elementor Widget: AI Workflow Showcase
 *
 * @package AI_Dev_Theme
 */

namespace AI_Dev_Theme\Widgets\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * AI Workflow Showcase Widget.
 */
class AI_Workflow_Showcase extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'ai_workflow_showcase';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return esc_html__( 'AI Workflow Showcase', 'ai-dev-theme' );
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-flow';
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return array( 'ai-dev-theme' );
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		// Content Tab
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'ai-dev-theme' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Section Title', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'AI-Driven Development Process', 'ai-dev-theme' ),
				'label_block' => true,
			)
		);

		$this->add_control(
			'subtitle',
			array(
				'label'       => esc_html__( 'Section Subtitle', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Intelligent Workflow', 'ai-dev-theme' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'       => esc_html__( 'Description', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'From requirement gathering to code review, our AI digital employees participate in the entire process, orchestrating a seamless flow.', 'ai-dev-theme' ),
			)
		);

		$this->end_controls_section();

		// Workflow Steps Tab
		$this->start_controls_section(
			'section_workflow',
			array(
				'label' => esc_html__( 'Workflow Steps', 'ai-dev-theme' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'step_title',
			array(
				'label'       => esc_html__( 'Step Title', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Step Name', 'ai-dev-theme' ),
			)
		);

		$repeater->add_control(
			'step_subtitle',
			array(
				'label'       => esc_html__( 'Step Subtitle', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Action', 'ai-dev-theme' ),
			)
		);

		$repeater->add_control(
			'step_icon',
			array(
				'label'       => esc_html__( 'Icon Class', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'fas fa-circle',
			)
		);

		$repeater->add_control(
			'step_color',
			array(
				'label'   => esc_html__( 'Color Style', 'ai-dev-theme' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => array(
					'primary'   => esc_html__( 'Primary', 'ai-dev-theme' ),
					'secondary' => esc_html__( 'Secondary', 'ai-dev-theme' ),
					'accent'    => esc_html__( 'Accent', 'ai-dev-theme' ),
					'info'      => esc_html__( 'Info', 'ai-dev-theme' ),
					'success'   => esc_html__( 'Success', 'ai-dev-theme' ),
					'warning'   => esc_html__( 'Warning', 'ai-dev-theme' ),
				),
			)
		);

		$this->add_control(
			'workflow_steps',
			array(
				'label'       => esc_html__( 'Steps', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'step_title'    => 'Requirement',
						'step_subtitle' => 'Collecting',
						'step_icon'     => 'fas fa-comments',
						'step_color'    => 'primary',
					),
					array(
						'step_title'    => 'Analysis',
						'step_subtitle' => 'Processing',
						'step_icon'     => 'fas fa-search-plus',
						'step_color'    => 'secondary',
					),
					array(
						'step_title'    => 'Quotation',
						'step_subtitle' => 'Automated',
						'step_icon'     => 'fas fa-file-invoice-dollar',
						'step_color'    => 'accent',
					),
					array(
						'step_title'    => 'Planning',
						'step_subtitle' => 'Scheduling',
						'step_icon'     => 'fas fa-tasks',
						'step_color'    => 'info',
					),
					array(
						'step_title'    => 'Doc Gen',
						'step_subtitle' => 'Specification',
						'step_icon'     => 'fas fa-file-alt',
						'step_color'    => 'warning',
					),
					array(
						'step_title'    => 'AI Coding',
						'step_subtitle' => 'MCP Execution',
						'step_icon'     => 'fas fa-code',
						'step_color'    => 'success',
					),
				),
				'title_field' => '{{{ step_title }}}',
			)
		);

		$this->end_controls_section();

		// Digital Employees Tab
		$this->start_controls_section(
			'section_employees',
			array(
				'label' => esc_html__( 'Digital Employees', 'ai-dev-theme' ),
			)
		);
		
		$this->add_control(
			'employees_title',
			array(
				'label'       => esc_html__( 'Section Title', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'AI Digital Workforce', 'ai-dev-theme' ),
			)
		);

		$repeater_employees = new \Elementor\Repeater();

		$repeater_employees->add_control(
			'emp_name',
			array(
				'label'       => esc_html__( 'Name', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Agent Name', 'ai-dev-theme' ),
			)
		);

		$repeater_employees->add_control(
			'emp_role',
			array(
				'label'       => esc_html__( 'Role Description', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Role Description', 'ai-dev-theme' ),
			)
		);
		
		$repeater_employees->add_control(
			'emp_model',
			array(
				'label'       => esc_html__( 'AI Model', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'GPT-4', 'ai-dev-theme' ),
			)
		);

		$repeater_employees->add_control(
			'emp_icon',
			array(
				'label'       => esc_html__( 'Icon Class', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'fas fa-robot',
			)
		);

		$repeater_employees->add_control(
			'emp_color',
			array(
				'label'   => esc_html__( 'Color Style', 'ai-dev-theme' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'primary',
				'options' => array(
					'primary'   => esc_html__( 'Primary', 'ai-dev-theme' ),
					'secondary' => esc_html__( 'Secondary', 'ai-dev-theme' ),
					'accent'    => esc_html__( 'Accent', 'ai-dev-theme' ),
					'info'      => esc_html__( 'Info', 'ai-dev-theme' ),
					'success'   => esc_html__( 'Success', 'ai-dev-theme' ),
					'warning'   => esc_html__( 'Warning', 'ai-dev-theme' ),
				),
			)
		);

		$this->add_control(
			'employees_list',
			array(
				'label'       => esc_html__( 'Employees', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_employees->get_controls(),
				'default'     => array(
					array(
						'emp_name'  => 'Code Reviewer',
						'emp_role'  => 'Audits code quality & security',
						'emp_model' => 'GPT-4o',
						'emp_icon'  => 'fas fa-user-shield',
						'emp_color' => 'primary',
					),
					array(
						'emp_name'  => 'Tech Stack Advisor',
						'emp_role'  => 'Recommends architecture',
						'emp_model' => 'Claude 3.5',
						'emp_icon'  => 'fas fa-layer-group',
						'emp_color' => 'secondary',
					),
					array(
						'emp_name'  => 'Quotation Analyst',
						'emp_role'  => 'Estimates cost & timeline',
						'emp_model' => 'Qwen Max',
						'emp_icon'  => 'fas fa-chart-line',
						'emp_color' => 'accent',
					),
					array(
						'emp_name'  => 'Requirement Collector',
						'emp_role'  => 'Structures user needs',
						'emp_model' => 'DeepSeek',
						'emp_icon'  => 'fas fa-clipboard-list',
						'emp_color' => 'info',
					),
				),
				'title_field' => '{{{ emp_name }}}',
			)
		);

		$this->end_controls_section();
		
		// Workbench Tab
		$this->start_controls_section(
			'section_workbench',
			array(
				'label' => esc_html__( 'Workbench Preview', 'ai-dev-theme' ),
			)
		);
		
		$this->add_control(
			'wb_title',
			array(
				'label'       => esc_html__( 'Workbench Title', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'AI Workbench - Project Dashboard', 'ai-dev-theme' ),
			)
		);
		
		$this->add_control(
			'wb_active_projects_title',
			array(
				'label'       => esc_html__( 'Active Projects Title', 'ai-dev-theme' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Active Projects', 'ai-dev-theme' ),
			)
		);
		
		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="ai-workflow-showcase overflow-hidden">
			<div class="text-center mb-xl fade-in-up">
				<h2 class="section-title">
					<?php if ( $settings['subtitle'] ) : ?>
						<span class="d-block h5 text-primary text-uppercase letter-spacing-sm mb-2"><?php echo esc_html( $settings['subtitle'] ); ?></span>
					<?php endif; ?>
					<?php echo esc_html( $settings['title'] ); ?>
				</h2>
				<?php if ( $settings['description'] ) : ?>
					<p class="section-subtitle" style="max-width: 800px; margin-left: auto; margin-right: auto;">
						<?php echo esc_html( $settings['description'] ); ?>
					</p>
				<?php endif; ?>
			</div>

			<!-- Workflow Steps -->
			<div class="workflow-steps mb-2xl">
				<!-- Desktop Horizontal Flow -->
				<div class="workflow-desktop-view">
					<!-- Connecting Line -->
					<div class="position-absolute top-0 start-0 w-100 border-top border-secondary border-dashed opacity-50" style="margin-top: 30px; z-index: 0;"></div>
					
					<?php 
					if ( ! empty( $settings['workflow_steps'] ) ) :
						foreach ( $settings['workflow_steps'] as $index => $step ) :
							?>
							<div class="workflow-step-item text-center position-relative z-1 flex-grow-1 px-3">
								<div class="step-icon d-inline-flex align-center justify-center rounded-circle bg-surface border border-<?php echo esc_attr( $step['step_color'] ); ?> mb-md position-relative shadow-sm" style="width: 60px; height: 60px;">
									<i class="<?php echo esc_attr( $step['step_icon'] ); ?> text-<?php echo esc_attr( $step['step_color'] ); ?> fa-lg"></i>
									<span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-<?php echo esc_attr( $step['step_color'] ); ?> small border border-surface"><?php echo intval( $index + 1 ); ?></span>
								</div>
								<h4 class="h6 mb-1"><?php echo esc_html( $step['step_title'] ); ?></h4>
								<p class="small text-muted mb-0"><?php echo esc_html( $step['step_subtitle'] ); ?></p>
							</div>
							<?php
						endforeach;
					endif;
					?>
				</div>

				<!-- Mobile Vertical Flow (Fallback) -->
				<div class="workflow-mobile-view">
					<div class="grid grid--2 gap-md">
						<?php 
						if ( ! empty( $settings['workflow_steps'] ) ) :
							foreach ( $settings['workflow_steps'] as $step ) :
								?>
								<div class="workflow-step-card p-3 bg-surface border border-secondary rounded text-center">
									<div class="d-inline-block text-<?php echo esc_attr( $step['step_color'] ); ?> mb-2"><i class="<?php echo esc_attr( $step['step_icon'] ); ?> fa-2x"></i></div>
									<h5 class="h6 mb-0"><?php echo esc_html( $step['step_title'] ); ?></h5>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>
			</div>

			<div class="grid grid--12 gap-xl align-center">
				<!-- AI Digital Employees (Left) -->
				<div class="grid-column-span-12 grid-column-span-lg-5 fade-in-up delay-200">
					<?php if ( $settings['employees_title'] ) : ?>
						<h3 class="h4 mb-lg text-uppercase letter-spacing-sm">
							<i class="fas fa-users-cog me-2 text-primary"></i><?php echo esc_html( $settings['employees_title'] ); ?>
						</h3>
					<?php endif; ?>
					
					<div class="d-flex flex-column gap-md">
						<?php
						if ( ! empty( $settings['employees_list'] ) ) :
							foreach ( $settings['employees_list'] as $employee ) :
								?>
								<div class="agent-card d-flex align-center p-md bg-surface border border-secondary rounded hover-transform transition-all">
									<div class="agent-avatar me-md position-relative">
										<div class="avatar-circle bg-surface-alt rounded-circle d-flex align-center justify-center border border-<?php echo esc_attr( $employee['emp_color'] ); ?>" style="width: 48px; height: 48px;">
											<i class="<?php echo esc_attr( $employee['emp_icon'] ); ?> text-<?php echo esc_attr( $employee['emp_color'] ); ?>"></i>
										</div>
										<div class="status-dot position-absolute bottom-0 end-0 bg-success rounded-circle border border-surface" style="width: 10px; height: 10px;"></div>
									</div>
									<div>
										<h4 class="h6 mb-0"><?php echo esc_html( $employee['emp_name'] ); ?></h4>
										<p class="small text-muted mb-0"><?php echo esc_html( $employee['emp_role'] ); ?></p>
									</div>
									<span class="ms-auto badge bg-<?php echo esc_attr( $employee['emp_color'] ); ?> bg-opacity-10 text-<?php echo esc_attr( $employee['emp_color'] ); ?> small"><?php echo esc_html( $employee['emp_model'] ); ?></span>
								</div>
								<?php
							endforeach;
						endif;
						?>
					</div>
				</div>

				<!-- AI Workbench Screenshot (Right) -->
				<div class="grid-column-span-12 grid-column-span-lg-7 fade-in-up delay-300">
					<div class="workbench-preview position-relative">
						<!-- Background Glow -->
						<div class="position-absolute top-50 start-50 translate-middle bg-primary opacity-20 blur-3xl rounded-circle" style="width: 400px; height: 400px; z-index: 0;"></div>
						
						<!-- Main Screenshot Window -->
						<div class="window-frame bg-surface border border-secondary rounded-lg shadow-2xl overflow-hidden position-relative z-1" style="transform: perspective(1000px) rotateY(-2deg);">
							<!-- Window Header -->
							<div class="window-header bg-surface-alt border-bottom border-secondary p-sm d-flex align-center justify-between">
								<div class="d-flex gap-xs">
									<span class="rounded-circle bg-danger" style="width: 10px; height: 10px;"></span>
									<span class="rounded-circle bg-warning" style="width: 10px; height: 10px;"></span>
									<span class="rounded-circle bg-success" style="width: 10px; height: 10px;"></span>
								</div>
								<div class="text-muted small mx-auto"><?php echo esc_html( $settings['wb_title'] ); ?></div>
								<div class="d-flex gap-sm text-muted small">
									<i class="fas fa-bell"></i>
									<i class="fas fa-cog"></i>
								</div>
							</div>
							
							<!-- Window Content (Simulated Dashboard) -->
							<div class="window-content bg-surface p-0">
								<div class="d-flex" style="height: 400px;">
									<!-- Sidebar -->
									<div class="sidebar bg-surface-alt border-end border-secondary p-3 d-none d-sm-block" style="width: 200px;">
										<div class="d-flex align-center gap-2 mb-4 text-primary">
											<i class="fas fa-robot fa-lg"></i>
											<span class="fw-bold">AI Workbench</span>
										</div>
										<div class="nav flex-column gap-2">
											<div class="nav-item p-2 rounded bg-primary bg-opacity-10 text-primary"><i class="fas fa-home me-2"></i> <?php esc_html_e( 'Dashboard', 'ai-dev-theme' ); ?></div>
											<div class="nav-item p-2 rounded text-muted"><i class="fas fa-project-diagram me-2"></i> <?php esc_html_e( 'Workflow', 'ai-dev-theme' ); ?></div>
											<div class="nav-item p-2 rounded text-muted"><i class="fas fa-users me-2"></i> <?php esc_html_e( 'Digital Employees', 'ai-dev-theme' ); ?></div>
											<div class="nav-item p-2 rounded text-muted"><i class="fas fa-file-code me-2"></i> <?php esc_html_e( 'Documents', 'ai-dev-theme' ); ?></div>
										</div>
									</div>
									
									<!-- Main Area -->
									<div class="main-area flex-grow-1 p-4 bg-surface-alt bg-opacity-50">
										<div class="d-flex justify-between align-center mb-4">
											<h4 class="h5 mb-0"><?php echo esc_html( $settings['wb_active_projects_title'] ); ?></h4>
											<button class="button button--sm button--primary"><i class="fas fa-plus me-1"></i> <?php esc_html_e( 'New Task', 'ai-dev-theme' ); ?></button>
										</div>
										
										<div class="grid grid--2 gap-3">
											<!-- Project Card 1 -->
											<div class="p-3 bg-surface rounded border border-secondary shadow-sm">
												<div class="d-flex justify-between mb-2">
													<span class="badge bg-warning bg-opacity-10 text-warning">In Progress</span>
													<i class="fas fa-ellipsis-h text-muted"></i>
												</div>
												<h5 class="h6 mb-1">SaaS Platform Dev</h5>
												<div class="progress-bar bg-surface-alt rounded-pill mb-2" style="height: 6px;">
													<div class="progress-bar__fill bg-warning h-100" style="width: 65%;"></div>
												</div>
												<div class="d-flex align-center gap-2 small text-muted">
													<i class="fas fa-robot text-primary"></i>
													<span>AI Coding...</span>
												</div>
											</div>
											
											<!-- Project Card 2 -->
											<div class="p-3 bg-surface rounded border border-secondary shadow-sm">
												<div class="d-flex justify-between mb-2">
													<span class="badge bg-success bg-opacity-10 text-success">Completed</span>
													<i class="fas fa-ellipsis-h text-muted"></i>
												</div>
												<h5 class="h6 mb-1">Marketing Website</h5>
												<div class="progress-bar bg-surface-alt rounded-pill mb-2" style="height: 6px;">
													<div class="progress-bar__fill bg-success h-100" style="width: 100%;"></div>
												</div>
												<div class="d-flex align-center gap-2 small text-muted">
													<i class="fas fa-check-circle text-success"></i>
													<span>Deployed</span>
												</div>
											</div>
										</div>
										
										<!-- Agent Activity Log -->
										<div class="mt-4 p-3 bg-terminal-body rounded border border-secondary font-secondary small text-success">
											<div class="mb-1"><span class="text-muted">10:42:01</span> [Requirement_Collector] User needs updated</div>
											<div class="mb-1"><span class="text-muted">10:42:05</span> [Tech_Stack_Advisor] Recommended stack: Next.js + Supabase</div>
											<div class="mb-1"><span class="text-muted">10:42:12</span> [Quote_Analyst] Estimation complete: 48h / $2.5k</div>
											<div><span class="text-primary">➜</span> <span class="blink">_</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php
	}
}
