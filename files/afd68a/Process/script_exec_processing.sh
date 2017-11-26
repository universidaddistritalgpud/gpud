#!/bin/bash
procesos=$(ps -ef | grep ./script_processing.sh | wc -l)
[ $procesos -le 1 ]
	result=1
	while [ $result -gt 0 ]; do
		result=$(curl http://localhost/tesisPPP//index.php?url=iniciarprocesamiento/ft/start)
		echo $result
 		done
