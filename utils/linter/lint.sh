CUR_DIR=$(pwd)

CONFIG_DIR=${CUR_DIR}/utils/linter/configs

if ! test -f ${CUR_DIR}/utils/linter/lint.sh; then
    echo "ERROR - You should start linter from root directory of the project"
    exit 2
fi

IS_CHECK_FAIL=0;

CHANGED_FILES=$(git status --porcelain ${CUR_DIR} | grep '^[MA]' | sed 's|^...||g');

ln -s ${CONFIG_DIR}/phpstan.neon ${CUR_DIR}/phpstan.neon
ln -s ${CONFIG_DIR}/duster.json ${CUR_DIR}/duster.json
ln -s ${CONFIG_DIR}/pint.json ${CUR_DIR}/pint.json
ln -s ${CONFIG_DIR}/tlint.json ${CUR_DIR}/tlint.json
ln -s ${CONFIG_DIR}/.phpcs.xml.dist ${CUR_DIR}/.phpcs.xml.dist
ln -s ${CONFIG_DIR}/.php-cs-fixer.dist.php ${CUR_DIR}/.php-cs-fixer.dist.php

if  [ -n "${CHANGED_FILES}" ]; then

    echo "************************************************"
    echo "CHECKING PROJECT:"
    echo "************************************************"
    echo "Changed Files:"
    echo ""
    echo ${CHANGED_FILES} | sed "s| |\n|g";
    echo "************************************************"

    ${CUR_DIR}/vendor/bin/duster fix ${CHANGED_FILES}
    if [ $? -ne 0 ]; then
        ${CUR_DIR}/vendor/bin/duster lint ${CHANGED_FILES}
        let IS_CHECK_FAIL=1;
    fi

    ${CUR_DIR}/vendor/bin/phpstan analyze -v -c ${CUR_DIR}/phpstan.neon ${CHANGED_FILES}
    if [ $? -ne 0 ]; then
        let IS_CHECK_FAIL=1;
    fi

    unlink ${CUR_DIR}/phpstan.neon
    unlink ${CUR_DIR}/duster.json
    unlink ${CUR_DIR}/pint.json
    unlink ${CUR_DIR}/tlint.json
    unlink ${CUR_DIR}/.phpcs.xml.dist
    unlink ${CUR_DIR}/.php-cs-fixer.dist.php
fi

if [ $IS_CHECK_FAIL -eq 1 ]; then
    echo "ERROR - Linters made changes"
    exit 1
fi
