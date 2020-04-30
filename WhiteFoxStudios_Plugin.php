<?php


include_once('WhiteFoxStudios_LifeCycle.php');

class WhiteFoxStudios_Plugin extends WhiteFoxStudios_LifeCycle {

    /**
     * See: http://plugin.michael-simpson.com/?page_id=31
     * @return array of option meta data.
     */
    public function getOptionMetaData() {/*
        //  http://plugin.michael-simpson.com/?page_id=31
        return array(
            //'_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
            'ATextInput' => array(__('Enter in some text', 'my-awesome-plugin')),
            'AmAwesome' => array(__('I like this awesome plugin', 'my-awesome-plugin'), 'false', 'true'),
            'CanDoSomething' => array(__('Which user role can do something', 'my-awesome-plugin'),
                                        'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone')
        );
    /**/}

//    protected function getOptionValueI18nString($optionValue) {
//        $i18nValue = parent::getOptionValueI18nString($optionValue);
//        return $i18nValue;
//    }

    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
                if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
    }

    public function getPluginDisplayName() {
        return 'White Fox Studios';
    }

    protected function getMainPluginFileName() {
        return 'white-fox-studios.php';
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Called by install() to create any database tables if needed.
     * Best Practice:
     * (1) Prefix all table names with $wpdb->prefix
     * (2) make table names lower case only
     * @return void
     */
    protected function installDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("CREATE TABLE IF NOT EXISTS `$tableName` (
        //            `id` INTEGER NOT NULL");
    }

    /**
     * See: http://plugin.michael-simpson.com/?page_id=101
     * Drop plugin-created tables on uninstall.
     * @return void
     */
    protected function unInstallDatabaseTables() {
        //        global $wpdb;
        //        $tableName = $this->prefixTableName('mytable');
        //        $wpdb->query("DROP TABLE IF EXISTS `$tableName`");
    }


    /**
     * Perform actions when upgrading from version X to version Y
     * See: http://plugin.michael-simpson.com/?page_id=35
     * @return void
     */
    public function upgrade() {
    }

    public function getAdminNotices() {
      global $pagenow;
      if($pagenow == 'index.php'): ?>
        <div class="notice wfs-admin-notice wfs-dashboard-notice">
        	<a href="https://whitefoxstudios.net/"><img src="<?php echo plugins_url('/img/logo-black.png', __FILE__); ?>" class="wfs-dash-logo"> <span class="dash-slogan">Data beats opinions!</span></a>
        </div><?
      endif;
    }

    public function addActionsAndFilters() {

      // Add options administration page
      // http://plugin.michael-simpson.com/?page_id=47
      add_action('admin_menu', array(&$this, 'addSettingsSubMenuPage'));

      ////////////////////////////////////////////////
      // Add Actions & Filters
      // http://plugin.michael-simpson.com/?page_id=37
      ////////////////////////////////////////////////
      
      // Admin Assets
      if(strpos($_SERVER['REQUEST_URI'], 'wp-admin')){
        wp_enqueue_style('white-fox-studios-admin-css', plugins_url('/css/wfs-admin.css', __FILE__));
        wp_enqueue_script('white-fox-studios-admin-js', plugins_url('/js/wfs-admin.js', __FILE__), array('jquery'), null, true);
      }
      
      // Settings Page Assets
      global $pagenow;
      if($pagenow == $this->getSettingsSlug()){
        wp_enqueue_style('white-fox-studios-settings-css', plugins_url('/css/wfs-settings.css', __FILE__));
        wp_enqueue_script('white-fox-studios-settings-js', plugins_url('/js/wfs-settings.js', __FILE__), array('jquery'), null, true);
      }
      
      // Dashboard Assets
      if($pagenow == 'index.php'){
        wp_enqueue_style('white-fox-studios-dashboard-css', plugins_url('/css/wfs-dashboard.css', __FILE__));
        wp_enqueue_script('white-fox-studios-dashboard-js', plugins_url('/js/wfs-dashboard.js', __FILE__), array('jquery'), null, true);
      }

      add_action('admin_notices', array(&$this, 'getAdminNotices'));


      ////////////////////////////////////////////////
      // Register short codes
      // http://plugin.michael-simpson.com/?page_id=39
      ////////////////////////////////////////////////


      ////////////////////////////////////////////////
      // Register AJAX hooks
      // http://plugin.michael-simpson.com/?page_id=41
      ////////////////////////////////////////////////

    }

}
