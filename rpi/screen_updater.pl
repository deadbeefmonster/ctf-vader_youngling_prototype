#!/usr/bin/perl
#
use strict;
use warnings;

use DBI;

my $db_filename = '/home/controlleradmin/docker/ctf-vader_youngling_prototype/rpi/vader-codes.db';
my $dbh = DBI->connect("dbi:SQLite:dbname=" . $db_filename, "", "");

my %flags;
$flags{'1'} = 'vad3rr1';
$flags{'2'} = 'vad3rr2';
$flags{'3'} = 'vad3rr3';

my @messages;

foreach my $flag_num (sort keys %flags) {
    my $flag_label = $flags{$flag_num};
    my $sql = "select * from codes_used where code_full like '".$flag_label."-%' order by ts desc limit 1";
    print "SQL=$sql\n";
    my $sth = $dbh->prepare($sql);
    $sth->execute();
    my $row = $sth->fetchrow_hashref;
    if ($row) {
	my ($sec, $min, $hour, $mday, $mon, $year, $wday, $yday, $isdst) = localtime($row->{'ts'});
	if ($hour < 10) { $hour = "0$hour"; }
	if ($min < 10) { $min = "0$min"; }
	
	my $message = "F $flag_num: $hour:$min";
	print "message=$message\n";
	push @messages, $message;
    }
    else {
	my $message = "F $flag_num: NA";
	print "message=$message\n";
	push @messages, $message;
    }
}

my $msg = join('-', @messages);
    
`/usr/bin/python /home/controlleradmin/NanoHatOLED/BakeBit/Software/Python/oled.py -t '$msg'`;
