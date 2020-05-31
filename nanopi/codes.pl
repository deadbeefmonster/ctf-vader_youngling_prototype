#!/usr/bin/perl
#
use strict;
use warnings;

use DBI;
use Linux::Inotify2;

my $lockfile = '/var/tmp/codes_pl.lock';
if (-e $lockfile) {
    exit(0);
}
my $ts = time();
open (my $lockfp, ">$lockfile");
print $lockfp "$ts\n";
close($lockfp);



my $DEBUG = 1;

my $inotify = new Linux::Inotify2;
my $db_filename = '/home/controlleradmin/docker/ctf-vader_youngling_prototype/rpi/vader-codes.db';
my %file_key_map;

$file_key_map{'/home/controlleradmin/docker/ctf-vader_youngling_prototype/rpi/www/docroot/backup/33a570074c287e136ae4d5ca969fa35a/7/alderan_kaboom_lol-flag-bb279f57d454d73cb.txt'} = 'vad3rr1';
$file_key_map{'/home/controlleradmin/docker/ctf-vader_youngling_prototype/rpi/www/docroot/backup/3f1d8bfe402b31572e2a4f412c125983/b/jedi_breaking_news-beep-beep-they_are_toast-flag-634a65f26.txt'} = 'vad3rr2';
$file_key_map{'/home/controlleradmin/docker/ctf-vader_youngling_prototype/rpi/www/docroot/backup/7f476dc832402654921d0169f0a7770d/8/your-training-is-growing-well-done_flag-6d142851.txt'} = 'vad3rr3';

# Start the watchers
foreach my $filename (keys %file_key_map) {
    print "INFO: Adding $filename for watching IN_ACCESS\n";

    $inotify->watch($filename, IN_ACCESS);
}

# Handle events
while () {
    my @events = $inotify->read;
    foreach my $event (@events) {
	my $filename = $event->fullname;
	print "DEBUG: filename=$filename\n" if $DEBUG;

        my $code_id = $file_key_map{$filename};
	print "DEBUG: code_id=$code_id\n" if $DEBUG;

	
	my $dbh = DBI->connect("dbi:SQLite:dbname=" . $db_filename, "", "");
	
	# Get code
	my $get_code_sql = 'select code from codes where is_available = 1';
	my $get_code_sth = $dbh->prepare($get_code_sql);
	$get_code_sth->execute();
	my $get_code_row = $get_code_sth->fetchrow_hashref;
	my $code_hash = $get_code_row->{'code'};
    
	my $code = $code_id . '-' . $code_hash;
	print "DEBUG: code=$code\n" if $DEBUG;
	
	# Mark code as unavailable
	my $update_code_sql = 'update codes set is_available = 0 where code = ?';
	my $update_code_sth = $dbh->prepare($update_code_sql);
	$update_code_sth->execute($code_hash);
	
	# Add log entry
	# CREATE TABLE codes_used (code varchar(8), code_full varchar(20), ts int, file varchar(200));
	my $update_log_sql = 'insert into codes_used (code, code_full, ts, file) values (?, ?, ?, ?)';
	my $update_log_sth = $dbh->prepare($update_log_sql);
	$update_log_sth->execute($code_hash, $code, time(), $filename);
	
	# Add code content to file
	open(my $fp, ">$filename");
	print $fp "Well done, you have demonstrated great skill. We will continue to watch you with great interest.\n\n";
	print $fp "You should know what to do with this flag: $code\n\n";
	print $fp "-Imperial Hackers of the New Order\n";
	close($fp);
    
	# Print to screen
	print "INFO: Code $code generated for filename $filename\n";
	$code =~ /vad3rr(\d+)/;
	my $flagnum = $1;
	`/usr/bin/python /home/controlleradmin/NanoHatOLED/BakeBit/Software/Python/oled.py -t 'FLAG $flagnum-FOUND'`;
    }
}

unlink($lockfile);
