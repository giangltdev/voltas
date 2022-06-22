<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'volta' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/** FTP config */
define("FS_METHOD", "direct");
/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '9^)U9*Q(/icGtdh7[i*`I;rlxHXH(CjE1./,^qwio_:q.&5{V8|8ZD)ka]jY@Xov' );
define( 'SECURE_AUTH_KEY',  '}>G4d2dYC$n2bFKfB8(GHTC@_8`@gq~rS~2e[bMB|:0geA)h|dM+;]4tsxcN@_U4' );
define( 'LOGGED_IN_KEY',    ',W|Pgg%C0[Ed,3Gx21d>YW<Mm9C_?H~Dk3!:.=pViBm;l2=+5AF[B>vE=Oq9<|/j' );
define( 'NONCE_KEY',        'G<yzHkZ`lvbJv9Ag]So{`dYY!,KxTVY#{<CYr/tfHu$-oQ_^<UZR*.V40*AVQc0D' );
define( 'AUTH_SALT',        '@|F:00(~n |M)vpD-.lyW~G@PY-TmAYIV`AsV:Tv[`6xnl^[W*=4{?|m#l15V}f$' );
define( 'SECURE_AUTH_SALT', 'Tp2$V1l{<7=lO1}yGVfP/O>O0i_lQx&#eX#bA[)4>kXsrOumE]){rZs4v0r<b=H<' );
define( 'LOGGED_IN_SALT',   'Lr0PykXd /MzdV3UZW ~WT.O5IPLxGaBLD%5$f>7(*(] :(>d+&0fet3prhdS0cF' );
define( 'NONCE_SALT',       'Q8a{0sPb}ppv73GhsxF6Ue_0F23QXpn?i4S$c`:LfZl9Bb=/EJ{ZT6?/!=qwb5&W' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
